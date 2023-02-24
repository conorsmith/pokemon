<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Exception;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly PlayerRepository $playerRepository,
        private readonly BagRepository $bagRepository,
        private readonly array $pokedex,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(): void
    {
        $id = substr($_SERVER['REQUEST_URI'], strlen("/encounter/"));

        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        $bag = $this->bagRepository->find();

        if (!$bag->hasAnyPokeBall()) {
            $this->session->getFlashBag()->add("errors", "No Poké Balls remaining.");
            header("Location: /map");
            exit;
        }

        $encounteredPokemon = $this->findEncounteredPokemon($id);

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => INSTANCE_ID,
            'number' => $encounteredPokemon->number,
        ]);

        $pokeballs = [];

        foreach ($bag->getEachPokeBall() as $pokeBall) {
            $pokeballs[] = self::createPokeBallViewModel($pokeBall);
        }

        $player = $this->playerRepository->findPlayer();
        $playerLeadPokemon = $player->hasEntireTeamFainted()
            ? $player->getLastFaintedPokemon()
            : $player->getLeadPokemon();

        echo TemplateEngine::render(__DIR__ . "/../Templates/Encounter.php", [
            'id' => $id,
            'encounteredPokemonIsRegistered' => $pokedexRow !== false,
            'opponentPokemon' => $this->viewModelFactory->createPokemonInBattle($encounteredPokemon),
            'playerPokemon' => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'pokeballs' => $pokeballs,
            'isLegendary' => $encounterRow['is_legendary'],
            'successes' => $this->session->getFlashBag()->get("successes"),
            'errors' => $this->session->getFlashBag()->get("errors"),
        ]);
    }

    private function findEncounteredPokemon(string $encounterId): ?Pokemon
    {
        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $encounterId,
        ]);

        if ($encounterRow === false) {
            return null;
        }

        $pokedexEntry = $this->pokedex[$encounterRow['pokemon_id']];

        $pokemon = new Pokemon(
            $encounterId,
            $encounterRow['pokemon_id'],
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $encounterRow['level'],
            0,
            $encounterRow['is_shiny'] === 1,
            self::createStats($encounterRow['pokemon_id']),
            $encounterRow['remaining_hp'] ?? 0,
            false //$encounterRow['has_fainted'] === 1,
        );

        if ($pokemon->remainingHp === 0) {
            $pokemon->remainingHp = $pokemon->calculateHp();
        }

        return $pokemon;
    }

    private static function createPokeBallViewModel(Item $pokeBall): stdClass
    {
        $itemConfig = require __DIR__ . "/../../Config/Items.php";

        return (object) [
            'id' => $pokeBall->id,
            'name' => $itemConfig[$pokeBall->id]['name'],
            'imageUrl' => $itemConfig[$pokeBall->id]['imageUrl'],
            'amount' => $pokeBall->quantity,
        ];
    }

    private static function createStats(string $number): Stats
    {
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return new Stats(
                    $entry['hp'],
                    $entry['attack'],
                    $entry['defence'],
                    $entry['spAttack'],
                    $entry['spDefence'],
                    $entry['speed'],
                );
            }
        }

        throw new Exception;
    }
}
