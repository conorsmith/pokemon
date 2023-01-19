<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;

final class GetPokedex
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $rowsByNumber = [];

        foreach ($rows as $row) {
            $rowsByNumber[$row['number']] = $row;
        }

        $viewModels = [];

        foreach ($this->pokedex as $number => $pokemon) {
            if (array_key_exists($number, $rowsByNumber)) {
                unset($rowsByNumber[$number]);
                $viewModels[$number] = (object) [
                    'name' => $pokemon['name'],
                    'imageUrl' => TeamMember::createImageUrl(strval($number)),
                    'primaryType' => ViewModelFactory::createPokemonTypeName($pokemon['type'][0]),
                    'secondaryType' => isset($pokemon['type'][1]) ? ViewModelFactory::createPokemonTypeName($pokemon['type'][1]) : "",
                ];
            } else {
                $viewModels[$number] = null;
            }
            if (count($rowsByNumber) === 0) {
                break;
            }
        }

        echo TemplateEngine::render(__DIR__ . "/../Templates/Pokedex.php", [
            'pokedex' => $viewModels,
        ]);
    }
}
