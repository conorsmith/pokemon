<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\ItemType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\LevelUpPokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepositoryDb;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamItemUse
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly array $pokedex,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $itemId = $args['id'];
        $pokemonId = $request->request->get('pokemon');

        $itemConfig = $this->itemConfigRepository->find($itemId);

        if ($itemId === ItemId::RARE_CANDY) {
            return $this->attemptToLevelUpPokemon($args['instanceId'], $pokemonId);

        } elseif ($itemConfig['type'] === ItemType::STATS) {
            return $this->attemptToAlterPokemonEvs($args['instanceId'], $pokemonId, $itemId, $itemConfig);

        } elseif ($itemConfig['type'] === ItemType::EVOLUTION) {
            return $this->attemptToEvolvePokemon($args['instanceId'], $itemId, $pokemonId);

        } else {
            throw new Exception("Unhandled item");
        }
    }

    private function attemptToAlterPokemonEvs(string $instanceId, string $pokemonId, string $itemId, array $itemConfig): Response
    {
        $bag = $this->bagRepository->find();

        if (!$bag->has($itemId)) {
            $this->session->getFlashBag()->add("errors", "No {$itemConfig['name']} remaining.");
            return new RedirectResponse("/{$instanceId}/team/use/" . $itemId);
        }

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            return new RedirectResponse("/{$instanceId}/team/use/" . $itemId);
        }

        $pokemon = match ($itemId) {
            ItemId::HP_UP   => $pokemon->boostHpEv(10),
            ItemId::PROTEIN => $pokemon->boostPhysicalAttackEv(10),
            ItemId::IRON    => $pokemon->boostPhysicalDefenceEv(10),
            ItemId::CALCIUM => $pokemon->boostSpecialAttackEv(10),
            ItemId::ZINC    => $pokemon->boostSpecialDefenceEv(10),
            ItemId::CARBOS  => $pokemon->boostSpeedEv(10),
        };

        $bag = $bag->use($itemId);

        $this->bagRepository->save($bag);
        $this->pokemonRepository->save($pokemon);

        return new RedirectResponse("/{$instanceId}/team/use/" . $itemId);
    }

    private function attemptToLevelUpPokemon(string $instanceId, string $pokemonId): Response
    {
        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::RARE_CANDY)) {
            $this->session->getFlashBag()->add("errors", "No rare candies remaining.");
            return new RedirectResponse("/{$instanceId}/team/use/" . ItemId::RARE_CANDY);
        }

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            return new RedirectResponse("/{$instanceId}/team/use/" . ItemId::RARE_CANDY);
        }

        $result = $this->levelUpPokemon->run($pokemonId);

        if ($result->beyondLevelLimit) {
            $this->session->getFlashBag()->add("errors", "You can't level up Pokémon beyond level {$result->levelLimit}");
            return new RedirectResponse("/{$instanceId}/team/use/" . ItemId::RARE_CANDY);
        }

        $bag = $bag->use(ItemId::RARE_CANDY);
        $this->bagRepository->save($bag);

        $pokemonConfig = $this->pokedex[$pokemon->number];

        $this->session->getFlashBag()->add("successes", "{$pokemonConfig['name']} levelled up to level {$result->newLevel}");

        if ($result->evolved) {
            $oldPokemon = $pokemonConfig;
            $newPokemon = $this->pokedex[$result->newPokedexNumber];
            $this->session->getFlashBag()->add("successes", "Your {$oldPokemon['name']} evolved into {$newPokemon['name']}!");
        }

        return new RedirectResponse("/{$instanceId}/team/use/" . ItemId::RARE_CANDY);
    }

    private function attemptToEvolvePokemon(string $instanceId, string $itemId, string $pokemonId): Response
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId and id = :pokemonId", [
            'instanceId' => $instanceId,
            'pokemonId' => $pokemonId,
        ]);

        $pokemonConfig = $this->pokedex[$pokemonRow['pokemon_id']];

        if (!array_key_exists('evolutions', $pokemonConfig)) {
            $this->session->getFlashBag()->add("successes", "That did nothing!");
            return new RedirectResponse("/{$instanceId}/team/use/{$itemId}");
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
            $this->session->getFlashBag()->add("successes", "That did nothing!");
            return new RedirectResponse("/{$instanceId}/team/use/{$itemId}");
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
            'number' => $newPokemonNumber,
        ]);

        if ($pokedexRow === false) {
            $this->db->insert("pokedex_entries", [
                'id' => Uuid::uuid4(),
                'instance_id' => $instanceId,
                'number' => $newPokemonNumber,
                'date_added' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "{$pokemonConfig['name']} evolved into {$this->pokedex[$newPokemonNumber]['name']}");
        return new RedirectResponse("/{$instanceId}/");
    }
}
