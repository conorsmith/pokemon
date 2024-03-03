<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Party\Domain\FixedEncounterCaptureEvent;
use ConorSmith\Pokemon\Party\Repositories\FixedEncounterCaptureEventRepositoryDb;
use ConorSmith\Pokemon\Party\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\SharedKernel\Commands\CatchPokemonCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\Commands\CatchPokemonResult;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class CatchPokemonCommand implements CommandInterface
{
    public function __construct(
        private readonly AddNewPokemon $addNewPokemon,
        private readonly FixedEncounterCaptureEventRepositoryDb $fixedEncounterCaptureEventRepositoryDb,
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
        ?string $fixedEncounterId,
        int $ivHp,
        int $ivPhysicalAttack,
        int $ivPhysicalDefence,
        int $ivSpecialAttack,
        int $ivSpecialDefence,
        int $ivSpeed,
        string $caughtLocationId,
    ): CatchPokemonResult {

        $partyPosition = $this->findOpenPartyPosition();

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
            $partyPosition,
        );

        if (!is_null($fixedEncounterId)) {
            $this->fixedEncounterCaptureEventRepositoryDb->save(new FixedEncounterCaptureEvent(
                Uuid::uuid4()->toString(),
                $fixedEncounterId,
                $caughtLocationId,
                $pokemon->number,
                CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ));
        }

        if (is_null($partyPosition)) {
            $this->friendshipLog->sentToBox($pokemon);
            return CatchPokemonResult::sentToBox();
        } else {
            $this->friendshipLog->sentToParty($pokemon);
            return CatchPokemonResult::sentToParty();
        }
    }

    private function findOpenPartyPosition(): ?int
    {
        $positionRow = $this->db->fetchNumeric("SELECT MAX(party_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $isPartyFull = $positionRow[0] >= 5;

        if ($isPartyFull) {
            return null;
        }

        return $positionRow[0] + 1;
    }
}
