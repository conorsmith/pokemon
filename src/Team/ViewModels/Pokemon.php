<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\ViewModels;

use ConorSmith\Pokemon\Team\Domain\Pokemon as DomainModel;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;

final class Pokemon
{
    public static function create(DomainModel $pokemon): self
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        $pokemonConfig = $config[$pokemon->number];

        return new self(
            $pokemon->id,
            $pokemonConfig['name'],
            TeamMember::createImageUrl($pokemon->number),
            ViewModelFactory::createPokemonTypeName($pokemonConfig['type'][0]),
            isset($pokemonConfig['type'][1]) ? ViewModelFactory::createPokemonTypeName($pokemonConfig['type'][1]) : null,
            strval($pokemon->level),
            strval($pokemon->friendship),
            match (true) {
                $pokemon->friendship === 255 => "fa-grin-stars",
                $pokemon->friendship >= 220  => "fa-grin-beam",
                $pokemon->friendship >= 200  => "fa-smile-beam",
                $pokemon->friendship >= 150  => "fa-smile",
                $pokemon->friendship >= 100  => "fa-meh",
                $pokemon->friendship >= 50   => "fa-frown",
                $pokemon->friendship >= 0    => "fa-angry",
            },
            $pokemon->isShiny,
        );
    }

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly ?string $secondaryType,
        public readonly string $level,
        public readonly string $friendship,
        public readonly string $friendshipIcon,
        public readonly bool $isShiny,
    ) {}
}
