<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Party\LevelUpPokemon;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Exception;
use LogicException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPartyItemUse
{
    public function __construct(
        private readonly Connection $db,
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $itemId = $args['id'];
        $pokemonId = $request->request->get('pokemon');

        $itemConfig = $this->itemConfigRepository->find($itemId);

        if ($itemId === ItemId::RARE_CANDY) {
            return $this->attemptToLevelUpPokemon($args['instanceId'], $pokemonId);

        } elseif ($itemId === ItemId::OVAL_CHARM) {
            return $this->redirectToBreedingPage($args['instanceId'], $pokemonId);

        } elseif ($itemConfig['type'] === ItemType::STATS) {
            return $this->attemptToAlterPokemonEvs($args['instanceId'], $pokemonId, $itemId, $itemConfig);

        } elseif ($itemConfig['type'] === ItemType::EVOLUTION) {
            return $this->attemptToEvolvePokemon($args['instanceId'], $itemId, $pokemonId);

        } else {
            throw new Exception("Unhandled item");
        }
    }

    private function redirectToBreedingPage(string $instanceId, string $pokemonId): RedirectResponse
    {
        return new RedirectResponse("/{$instanceId}/party/member/{$pokemonId}/breed");
    }

    private function attemptToAlterPokemonEvs(string $instanceId, string $pokemonId, string $itemId, array $itemConfig): Response
    {
        $bag = $this->bagRepository->find();

        if (!$bag->has($itemId)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No {$itemConfig['name']} remaining.")
            );
            return new RedirectResponse("/{$instanceId}/party/use/" . $itemId);
        }

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found.")
            );
            return new RedirectResponse("/{$instanceId}/party/use/" . $itemId);
        }

        $pokemon = match ($itemId) {
            ItemId::HP_UP   => $pokemon->boostHpEv(10),
            ItemId::PROTEIN => $pokemon->boostPhysicalAttackEv(10),
            ItemId::IRON    => $pokemon->boostPhysicalDefenceEv(10),
            ItemId::CALCIUM => $pokemon->boostSpecialAttackEv(10),
            ItemId::ZINC    => $pokemon->boostSpecialDefenceEv(10),
            ItemId::CARBOS  => $pokemon->boostSpeedEv(10),
            default         => throw new LogicException(),
        };

        $bag = $bag->use($itemId);

        $this->bagRepository->save($bag);
        $this->pokemonRepository->save($pokemon);

        return new RedirectResponse("/{$instanceId}/party/use/" . $itemId);
    }

    private function attemptToLevelUpPokemon(string $instanceId, string $pokemonId): Response
    {
        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::RARE_CANDY)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No rare candies remaining.")
            );
            return new RedirectResponse("/{$instanceId}/party/use/" . ItemId::RARE_CANDY);
        }

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found.")
            );
            return new RedirectResponse("/{$instanceId}/party/use/" . ItemId::RARE_CANDY);
        }

        $result = $this->levelUpPokemon->run($pokemonId);

        if ($result->beyondLevelLimit) {
            $this->notifyPlayerCommand->run(
                Notification::transient("You can't level up Pokémon beyond level {$result->levelLimit}")
            );
            return new RedirectResponse("/{$instanceId}/party/use/" . ItemId::RARE_CANDY);
        }

        $bag = $bag->use(ItemId::RARE_CANDY);
        $this->bagRepository->save($bag);

        $pokemonConfig = $this->pokedexConfigRepository->find($pokemon->number);

        $this->notifyPlayerCommand->run(
            Notification::persistent("{$pokemonConfig['name']} levelled up to level {$result->newLevel}")
        );

        if ($result->evolved) {
            $oldPokemon = $pokemonConfig;
            $newPokemon = $this->pokedexConfigRepository->find($result->newPokedexNumber);
            $this->notifyPlayerCommand->run(
                Notification::persistent("Your {$oldPokemon['name']} evolved into {$newPokemon['name']}!")
            );
        }

        return new RedirectResponse("/{$instanceId}/party/use/" . ItemId::RARE_CANDY);
    }

    private function attemptToEvolvePokemon(string $instanceId, string $itemId, string $pokemonId): Response
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId and id = :pokemonId", [
            'instanceId' => $instanceId,
            'pokemonId'  => $pokemonId,
        ]);

        $pokemonConfig = $this->pokedexConfigRepository->find($pokemonRow['pokemon_id']);

        if (!array_key_exists('evolutions', $pokemonConfig)) {
            $this->notifyPlayerCommand->run(
                Notification::persistent("That did nothing!")
            );
            return new RedirectResponse("/{$instanceId}/party/use/{$itemId}");
        }

        $canEvolveUsingThisItem = false;
        $newPokemonNumber = null;

        foreach ($pokemonConfig['evolutions'] as $pokemonNumber => $evolutionConfig) {
            if (array_key_exists('item', $evolutionConfig)
                && $evolutionConfig['item'] === $itemId
            ) {
                $canEvolveUsingThisItem = true;
                $newPokemonNumber = $pokemonNumber;
            }
        }

        if ($canEvolveUsingThisItem === false) {
            $this->notifyPlayerCommand->run(
                Notification::persistent("That did nothing!")
            );
            return new RedirectResponse("/{$instanceId}/party/use/{$itemId}");
        }

        $bag = $this->bagRepository->find();

        $bag = $bag->use($itemId);

        $this->db->beginTransaction();

        $this->bagRepository->save($bag);

        $this->db->update("caught_pokemon", [
            'pokemon_id' => $newPokemonNumber,
        ], [
            'id' => $pokemonId,
        ]);

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $instanceId,
            'number'     => $newPokemonNumber,
        ]);

        if ($pokedexRow === false) {
            $this->db->insert("pokedex_entries", [
                'id'          => Uuid::uuid4(),
                'instance_id' => $instanceId,
                'number'      => $newPokemonNumber,
                'date_added'  => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        $this->db->commit();

        $newPokemonPokedexEntry = $this->pokedexConfigRepository->find($newPokemonNumber);

        $this->notifyPlayerCommand->run(
            Notification::persistent("{$pokemonConfig['name']} evolved into {$newPokemonPokedexEntry['name']}")
        );
        return new RedirectResponse("/{$instanceId}/");
    }
}
