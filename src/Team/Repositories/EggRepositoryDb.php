<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\Team\Domain\Egg;
use ConorSmith\Pokemon\Team\Domain\EggRepository;
use Doctrine\DBAL\Connection;

final class EggRepositoryDb implements EggRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function all(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM eggs WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $eggs = [];

        foreach ($rows as $row) {
            $eggs[] = new Egg(
                $row['id'],
                $row['pokedex_number'],
                $row['form'],
                intval($row['iv_hp']),
                intval($row['iv_physical_attack']),
                intval($row['iv_physical_defence']),
                intval($row['iv_special_attack']),
                intval($row['iv_special_defence']),
                intval($row['iv_speed']),
                $row['first_parent_pokedex_number'],
                match ($row['first_parent_sex']) {
                    "F" => Sex::FEMALE,
                    "M" => Sex::MALE,
                    "U" => Sex::UNKNOWN,
                },
                $row['second_parent_pokedex_number'],
                match ($row['second_parent_sex']) {
                    "F" => Sex::FEMALE,
                    "M" => Sex::MALE,
                    "U" => Sex::UNKNOWN,
                },
                intval($row['remaining_cycles']),
            );
        }

        return $eggs;
    }

    public function save(Egg $egg): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM eggs WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id' => $egg->id,
        ]);

        if ($row === false) {
            $this->db->insert("eggs", [
                'id' => $egg->id,
                'instance_id' => $this->instanceId->value,
                'pokedex_number' => $egg->pokedexNumber,
                'form' => $egg->form,
                'iv_hp' => $egg->ivHp,
                'iv_physical_attack' => $egg->ivPhysicalAttack,
                'iv_physical_defence' => $egg->ivPhysicalDefence,
                'iv_special_attack' => $egg->ivSpecialAttack,
                'iv_special_defence' => $egg->ivSpecialDefence,
                'iv_speed' => $egg->ivSpeed,
                'first_parent_pokedex_number' => $egg->firstParentPokedexNumber,
                'first_parent_sex' => match ($egg->firstParentSex) {
                    Sex::FEMALE => "F",
                    Sex::MALE => "M",
                    Sex::UNKNOWN => "U",
                },
                'second_parent_pokedex_number' => $egg->secondParentPokedexNumber,
                'second_parent_sex' => match ($egg->secondParentSex) {
                    Sex::FEMALE => "F",
                    Sex::MALE => "M",
                    Sex::UNKNOWN => "U",
                },
                'remaining_cycles' => $egg->remainingCycles,
            ]);
        } else {
            $this->db->update("eggs", [
                'remaining_cycles' => $egg->remainingCycles,
            ], [
                'id' => $egg->id,
            ]);
        }
    }
}
