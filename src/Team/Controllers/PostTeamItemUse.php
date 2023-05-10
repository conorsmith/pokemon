<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\LevelUpPokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamItemUse
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly array $pokedex,
    ) {}

    public function __invoke(array $args): void
    {
        $itemId = $args['id'];
        $pokemonId = $_POST['pokemon'];

        if ($itemId === ItemId::RARE_CANDY) {
            $this->attemptToLevelUpPokemon($pokemonId);
            return;
        }

        $this->attemptToEvolvePokemon($itemId, $pokemonId);
    }

    private function attemptToLevelUpPokemon(string $pokemonId): void
    {
        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::RARE_CANDY)) {
            $this->session->getFlashBag()->add("errors", "No rare candies remaining.");
            header("Location: /team/use/" . ItemId::RARE_CANDY);
            return;
        }

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            header("Location: /team/use/" . ItemId::RARE_CANDY);
            return;
        }

        $result = $this->levelUpPokemon->run($pokemonId);

        if ($result->beyondLevelLimit) {
            $this->session->getFlashBag()->add("errors", "You can't level up Pokémon beyond level {$result->levelLimit}");
            header("Location: /team/use/" . ItemId::RARE_CANDY);
            return;
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

        header("Location: /team/use/" . ItemId::RARE_CANDY);
    }

    private function attemptToEvolvePokemon(string $itemId, string $pokemonId): void
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId and id = :pokemonId", [
            'instanceId' => INSTANCE_ID,
            'pokemonId' => $pokemonId,
        ]);

        $pokemonConfig = $this->pokedex[$pokemonRow['pokemon_id']];

        if (!array_key_exists('evolutions', $pokemonConfig)) {
            $this->session->getFlashBag()->add("successes", "That did nothing!");
            header("Location: /team/use/{$itemId}");
            return;
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
            header("Location: /team/use/{$itemId}");
            return;
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
            'instanceId' => INSTANCE_ID,
            'number' => $newPokemonNumber,
        ]);

        if ($pokedexRow === false) {
            $this->db->insert("pokedex_entries", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'number' => $newPokemonNumber,
                'date_added' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "{$pokemonConfig['name']} evolved into {$this->pokedex[$newPokemonNumber]['name']}");
        header("Location: /");
    }
}
