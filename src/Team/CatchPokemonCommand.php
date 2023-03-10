<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonResult;
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
        private readonly PokemonConfigRepository $pokemonConfigRepository,
    ) {}

    public function run(
        string $number,
        bool $isShiny,
        int $level,
        bool $isLegendary,
        string $caughtLocationId,
    ): CatchPokemonResult {

        $positionRow = $this->db->fetchNumeric("SELECT MAX(team_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $isTeamFull = $positionRow[0] >= 5;

        if ($isTeamFull) {
            $teamPosition = null;
        } else {
            $teamPosition = $positionRow[0] + 1;
        }

        $baseStats = self::createBaseStats($number);

        $pokemon = new Pokemon(
            Uuid::uuid4()->toString(),
            $number,
            $this->pokemonConfigRepository->findType($number),
            $level,
            0,
            $isShiny,
            new Hp($baseStats['hp'], mt_rand(0, 31)),
            new Stat($baseStats['attack'], mt_rand(0, 31)),
            new Stat($baseStats['defence'], mt_rand(0, 31)),
            new Stat($baseStats['spAttack'], mt_rand(0, 31)),
            new Stat($baseStats['spDefence'], mt_rand(0, 31)),
            new Stat($baseStats['speed'], mt_rand(0, 31)),
        );

        $this->db->insert("caught_pokemon", [
            'id' => $pokemon->id,
            'instance_id' => INSTANCE_ID,
            'pokemon_id' => $pokemon->number,
            'is_shiny' => $pokemon->isShiny ? 1 : 0,
            'iv_physical_attack' => $pokemon->physicalAttack->iv,
            'iv_physical_defence' => $pokemon->physicalDefence->iv,
            'iv_special_attack' => $pokemon->specialAttack->iv,
            'iv_special_defence' => $pokemon->specialDefence->iv,
            'iv_speed' => $pokemon->speed->iv,
            'iv_hp' => $pokemon->hp->iv,
            'level' => $pokemon->level,
            'team_position' => $teamPosition,
            'location' => $isTeamFull ? "box" : "team",
            'has_fainted' => 0,
            'location_caught' => $caughtLocationId,
            'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ]);

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => INSTANCE_ID,
            'number' => $pokemon->number,
        ]);

        if ($pokedexRow === false) {
            $this->db->insert("pokedex_entries", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'number' => $pokemon->number,
                'date_added' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        if ($isLegendary) {
            $this->db->insert("legendary_captures", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
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
