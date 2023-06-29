<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonResult;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\RegisterNewPokemonCommand;
use ConorSmith\Pokemon\Team\Domain\CaughtLocation;
use ConorSmith\Pokemon\Team\Domain\Hp;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\Stat;
use ConorSmith\Pokemon\Team\Repositories\PokemonConfigRepository;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class CatchPokemonCommand implements CommandInterface
{
    public function __construct(
        private readonly Connection $db,
        private readonly FriendshipLog $friendshipLog,
        private readonly RegisterNewPokemonCommand $registerNewPokemonCommand,
        private readonly PokemonConfigRepository $pokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(
        string $number,
        ?string $form,
        bool $isShiny,
        int $level,
        bool $isLegendary,
        int $ivHp,
        int $ivPhysicalAttack,
        int $ivPhysicalDefence,
        int $ivSpecialAttack,
        int $ivSpecialDefence,
        int $ivSpeed,
        string $caughtLocationId,
    ): CatchPokemonResult {

        $positionRow = $this->db->fetchNumeric("SELECT MAX(team_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $isTeamFull = $positionRow[0] >= 5;

        if ($isTeamFull) {
            $teamPosition = null;
        } else {
            $teamPosition = $positionRow[0] + 1;
        }

        $baseStats = self::createBaseStats($number);
        $caughtLocationConfig = $this->locationConfigRepository->findLocation($caughtLocationId);

        $pokemon = new Pokemon(
            Uuid::uuid4()->toString(),
            $number,
            $form,
            $this->pokemonConfigRepository->findType($number),
            $level,
            0,
            $isShiny,
            new Hp($baseStats['hp'], $ivHp, 0),
            new Stat($baseStats['attack'], $ivPhysicalAttack, 0),
            new Stat($baseStats['defence'], $ivPhysicalDefence, 0),
            new Stat($baseStats['spAttack'], $ivSpecialAttack, 0),
            new Stat($baseStats['spDefence'], $ivSpecialDefence, 0),
            new Stat($baseStats['speed'], $ivSpeed, 0),
            new CaughtLocation(
                $caughtLocationId,
                $caughtLocationConfig['region'],
            ),
        );

        $this->db->insert("caught_pokemon", [
            'id' => $pokemon->id,
            'instance_id' => $this->instanceId->value,
            'pokemon_id' => $pokemon->number,
            'form' => $form,
            'is_shiny' => $pokemon->isShiny ? 1 : 0,
            'iv_physical_attack' => $pokemon->physicalAttack->iv,
            'iv_physical_defence' => $pokemon->physicalDefence->iv,
            'iv_special_attack' => $pokemon->specialAttack->iv,
            'iv_special_defence' => $pokemon->specialDefence->iv,
            'iv_speed' => $pokemon->speed->iv,
            'iv_hp' => $pokemon->hp->iv,
            'ev_physical_attack' => 0,
            'ev_physical_defence' => 0,
            'ev_special_attack' => 0,
            'ev_special_defence' => 0,
            'ev_speed' => 0,
            'ev_hp' => 0,
            'level' => $pokemon->level,
            'team_position' => $teamPosition,
            'location' => $isTeamFull ? "box" : "team",
            'has_fainted' => 0,
            'location_caught' => $caughtLocationId,
            'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ]);

        $this->registerNewPokemonCommand->run($pokemon->number, $pokemon->form);

        if ($isLegendary) {
            $this->db->insert("legendary_captures", [
                'id' => Uuid::uuid4(),
                'instance_id' => $this->instanceId->value,
                'pokemon_id' => $pokemon->number,
                'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        if ($isTeamFull) {
            $this->friendshipLog->sentToBox($pokemon);
            return CatchPokemonResult::sentToBox();
        } else {
            $this->friendshipLog->sentToTeam($pokemon);
            return CatchPokemonResult::sentToTeam();
        }
    }

    private static function createBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }
}
