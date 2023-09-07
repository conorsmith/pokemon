<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\UseCases;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\Domain\CaughtLocation;
use ConorSmith\Pokemon\Party\Domain\EggGroups;
use ConorSmith\Pokemon\Party\Domain\Hp;
use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\Stat;
use ConorSmith\Pokemon\Party\Domain\Type;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\RegisterNewPokemonCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class AddNewPokemon
{
    public function __construct(
        private readonly Connection $db,
        private readonly RegisterNewPokemonCommand $registerNewPokemonCommand,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(
        string $number,
        ?string $form,
        int $level,
        Sex $sex,
        bool $isShiny,
        int $ivHp,
        int $ivPhysicalAttack,
        int $ivPhysicalDefence,
        int $ivSpecialAttack,
        int $ivSpecialDefence,
        int $ivSpeed,
        string $caughtLocationId,
        ?int $partyPosition,
    ): Pokemon {

        $isPartyFull = is_null($partyPosition);

        $baseStats = self::createBaseStats($number);
        $caughtLocationConfig = $this->locationConfigRepository->findLocation($caughtLocationId);
        $pokedexConfig = $this->pokedexConfigRepository->find($number);

        $pokemon = new Pokemon(
            Uuid::uuid4()->toString(),
            $number,
            $form,
            new Type(
                $pokedexConfig['type'][0],
                $pokedexConfig['type'][1] ?? null,
            ),
            new EggGroups(
                $pokedexConfig['eggGroups'][0],
                $pokedexConfig['eggGroups'][1] ?? null,
            ),
            $level,
            0,
            $sex,
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
            'id'                  => $pokemon->id,
            'instance_id'         => $this->instanceId->value,
            'pokemon_id'          => $pokemon->number,
            'form'                => $form,
            'sex'                 => match ($sex) {
                Sex::FEMALE  => "F",
                Sex::MALE    => "M",
                Sex::UNKNOWN => "U",
            },
            'is_shiny'            => $pokemon->isShiny ? 1 : 0,
            'iv_physical_attack'  => $pokemon->physicalAttack->iv,
            'iv_physical_defence' => $pokemon->physicalDefence->iv,
            'iv_special_attack'   => $pokemon->specialAttack->iv,
            'iv_special_defence'  => $pokemon->specialDefence->iv,
            'iv_speed'            => $pokemon->speed->iv,
            'iv_hp'               => $pokemon->hp->iv,
            'ev_physical_attack'  => 0,
            'ev_physical_defence' => 0,
            'ev_special_attack'   => 0,
            'ev_special_defence'  => 0,
            'ev_speed'            => 0,
            'ev_hp'               => 0,
            'level'               => $pokemon->level,
            'party_position'      => $partyPosition,
            'location'            => $isPartyFull ? "box" : "team",
            'has_fainted'         => 0,
            'location_caught'     => $caughtLocationId,
            'date_caught'         => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ]);

        $this->registerNewPokemonCommand->run($pokemon->number, $pokemon->form);

        return $pokemon;
    }

    private static function createBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }
}
