<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonResult;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\Team\UseCases\AddNewPokemon;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class CatchPokemonCommand implements CommandInterface
{
    public function __construct(
        private readonly AddNewPokemon $addNewPokemon,
        private readonly Connection $db,
        private readonly FriendshipLog $friendshipLog,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(
        string $number,
        ?string $form,
        int $level,
        Sex $sex,
        bool $isShiny,
        bool $isLegendary,
        int $ivHp,
        int $ivPhysicalAttack,
        int $ivPhysicalDefence,
        int $ivSpecialAttack,
        int $ivSpecialDefence,
        int $ivSpeed,
        string $caughtLocationId,
    ): CatchPokemonResult {

        $teamPosition = $this->findOpenTeamPosition();

        $pokemon = $this->addNewPokemon->run(
            $number,
            $form,
            $level,
            $sex,
            $isShiny,
            $ivHp,
            $ivPhysicalAttack,
            $ivPhysicalDefence,
            $ivSpecialAttack,
            $ivSpecialDefence,
            $ivSpeed,
            $caughtLocationId,
            $teamPosition,
        );

        if ($isLegendary) {
            $this->db->insert("legendary_captures", [
                'id' => Uuid::uuid4(),
                'instance_id' => $this->instanceId->value,
                'pokemon_id' => $pokemon->number,
                'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        if (is_null($teamPosition)) {
            $this->friendshipLog->sentToBox($pokemon);
            return CatchPokemonResult::sentToBox();
        } else {
            $this->friendshipLog->sentToTeam($pokemon);
            return CatchPokemonResult::sentToTeam();
        }
    }

    private function findOpenTeamPosition(): ?int
    {
        $positionRow = $this->db->fetchNumeric("SELECT MAX(team_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $isTeamFull = $positionRow[0] >= 5;

        if ($isTeamFull) {
            return null;
        }

        return $positionRow[0] + 1;
    }
}
