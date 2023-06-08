<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Repositories;

use ConorSmith\Pokemon\Pokedex\Domain\FormEntry;
use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\PokedexConfigRepository;
use Doctrine\DBAL\Connection;

final class PokedexEntryRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function all(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $multipleFormRows = [];

        foreach ($rows as $row) {
            if (is_null($row['form'])) {
                continue;
            }

            if (!array_key_exists($row['number'], $multipleFormRows)) {
                $multipleFormRows[$row['number']] = [];
            }

            $multipleFormRows[$row['number']][$row['form']] = $row;
        }

        $rowsByNumber = [];

        foreach ($rows as $row) {
            $rowsByNumber[$row['number']] = $row;
        }

        $entries = [];

        foreach ($this->pokedexConfigRepository->all() as $number => $config) {
            if (array_key_exists($number, $rowsByNumber)) {
                $entries[] = PokemonEntry::createRegistered(
                    strval($number),
                    self::createFormEntries($config, $multipleFormRows[$number] ?? []),
                );
            } else {
                $entries[] = PokemonEntry::createUnknown(strval($number));
            }
        }

        return $entries;
    }

    public function find(string $pokedexNumber): PokemonEntry
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :pokedexNumber", [
            'instanceId' => INSTANCE_ID,
            'pokedexNumber' => $pokedexNumber,
        ]);

        if (count($rows) === 0) {
            return PokemonEntry::createUnknown($pokedexNumber);
        }

        $multipleFormRows = [];

        foreach ($rows as $row) {
            if (is_null($row['form'])) {
                continue;
            }

            if (!array_key_exists($row['number'], $multipleFormRows)) {
                $multipleFormRows[$row['number']] = [];
            }

            $multipleFormRows[$row['number']][$row['form']] = $row;
        }

        return self::createRegisteredPokemonEntry(
            $this->pokedexConfigRepository->find($pokedexNumber),
            $rows[0],
            $multipleFormRows,
        );
    }

    public function getFinalEntry(): PokemonEntry
    {
        $config = $this->pokedexConfigRepository->all();

        $configKeys = array_keys($config);
        $finalKey = array_pop($configKeys);

        return $this->find(strval($finalKey));
    }

    private static function createRegisteredPokemonEntry(array $config, array $row, array $multipleFormRows): PokemonEntry
    {
        return PokemonEntry::createRegistered(
            strval($row['number']),
            self::createFormEntries($config, $multipleFormRows[$row['number']] ?? []),
        );
    }

    private static function createFormEntries(array $config, array $registeredFormRows): array
    {
        if (!array_key_exists('forms', $config)) {
            return [];
        }

        $entries = [];

        foreach ($config['forms'] as $formId) {
            if (array_key_exists($formId, $registeredFormRows)) {
                $entries[] = FormEntry::createRegistered($formId);
            } else {
                $entries[] = FormEntry::createUnknown($formId);
            }
        }

        return $entries;
    }
}
