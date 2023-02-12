<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly array $pokedex,
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

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => INSTANCE_ID,
            'number' => $encounterRow['pokemon_id'],
        ]);

        $leadPokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NOT NULL ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        $encounteredPokemon = $this->pokedex[$encounterRow['pokemon_id']];

        $pokemon = (object) [
            'name'         => $encounteredPokemon['name'],
            'imageUrl'     => TeamMember::createImageUrl($encounterRow['pokemon_id']),
            'level'        => $encounterRow['level'],
            'isRegistered' => $pokedexRow !== false,
            'isShiny'      => $encounterRow['is_shiny'],
        ];

        $leadPokemon = (object) [
            'name'     => $this->pokedex[$leadPokemonRow['pokemon_id']]['name'],
            'imageUrl' => TeamMember::createImageUrl($leadPokemonRow['pokemon_id']),
            'level'    => $leadPokemonRow['level'],
            'isShiny'  => $leadPokemonRow['is_shiny'],
        ];

        $pokeballs = [];

        foreach ($bag->getEachPokeBall() as $pokeBall) {
            $pokeballs[] = self::createPokeBallViewModel($pokeBall);
        }

        echo TemplateEngine::render(__DIR__ . "/../Templates/Encounter.php", [
            'id' => $id,
            'pokemon' => $pokemon,
            'leadPokemon' => $leadPokemon,
            'pokeballs' => $pokeballs,
            'isLegendary' => $encounterRow['is_legendary'],
            'successes' => $this->session->getFlashBag()->get("successes"),
            'errors' => $this->session->getFlashBag()->get("errors"),
        ]);
    }

    private static function createPokeBallViewModel(Item $pokeBall): stdClass
    {
        $itemConfig = require __DIR__ . "/../Config/Items.php";

        return (object) [
            'id' => $pokeBall->id,
            'name' => $itemConfig[$pokeBall->id]['name'],
            'imageUrl' => $itemConfig[$pokeBall->id]['imageUrl'],
            'amount' => $pokeBall->quantity,
        ];
    }
}
