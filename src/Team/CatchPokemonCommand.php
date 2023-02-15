<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonResult;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class CatchPokemonCommand implements CommandInterface
{
    public function __construct(
        private readonly Connection $db,
        private readonly FriendshipLog $friendshipLog,
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

        $pokemon = new Pokemon(
            Uuid::uuid4()->toString(),
            $number,
            $level,
            0,
            $isShiny,
        );

        $this->db->insert("caught_pokemon", [
            'id' => $pokemon->id,
            'instance_id' => INSTANCE_ID,
            'pokemon_id' => $pokemon->number,
            'is_shiny' => $pokemon->isShiny ? 1 : 0,
            'level' => $pokemon->level,
            'team_position' => $teamPosition,
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
}
