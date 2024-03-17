<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Egg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggParents;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stats;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use RuntimeException;

final class EggRepositoryDb implements EggRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function all(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM eggs WHERE instance_id = :instanceId ORDER BY pokedex_number", [
            'instanceId' => $this->instanceId->value,
        ]);

        $eggs = [];

        foreach ($rows as $row) {

            if ((is_null($row['first_parent_id']) && !is_null($row['second_parent_id']))
                || (!is_null($row['first_parent_id']) && is_null($row['second_parent_id']))
            ) {
                throw new RuntimeException();
            }

            if (is_null($row['first_parent_id']) && is_null($row['second_parent_id'])) {
                $parents = null;
            } else {
                $parents = new EggParents(
                    $row['first_parent_id'],
                    $row['second_parent_id'],
                );
            }

            $eggs[] = new Egg(
                $row['id'],
                $row['pokedex_number'],
                $row['form'],
                new Stats(
                    intval($row['iv_hp']),
                    intval($row['iv_physical_attack']),
                    intval($row['iv_physical_defence']),
                    intval($row['iv_special_attack']),
                    intval($row['iv_special_defence']),
                    intval($row['iv_speed']),
                ),
                $parents,
                intval($row['remaining_cycles']),
            );
        }

        return $eggs;
    }

    public function save(Egg $egg): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM eggs WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id'         => $egg->id,
        ]);

        if ($row === false) {
            $this->db->insert("eggs", [
                'id'                  => $egg->id,
                'instance_id'         => $this->instanceId->value,
                'pokedex_number'      => $egg->pokedexNumber,
                'form'                => $egg->form,
                'iv_hp'               => $egg->ivs->hp,
                'iv_physical_attack'  => $egg->ivs->physicalAttack,
                'iv_physical_defence' => $egg->ivs->physicalDefence,
                'iv_special_attack'   => $egg->ivs->specialAttack,
                'iv_special_defence'  => $egg->ivs->specialDefence,
                'iv_speed'            => $egg->ivs->speed,
                'first_parent_id'     => $egg->hasKnownParents() ? $egg->parents->firstParentId : null,
                'second_parent_id'    => $egg->hasKnownParents() ? $egg->parents->secondParentId : null,
                'remaining_cycles'    => $egg->remainingCycles,
            ]);
        } else {
            $this->db->update("eggs", [
                'remaining_cycles' => $egg->remainingCycles,
            ], [
                'id' => $egg->id,
            ]);
        }
    }

    public function remove(Egg $egg): void
    {
        $this->db->delete("eggs", [
            'id' => $egg->id,
        ]);
    }
}
