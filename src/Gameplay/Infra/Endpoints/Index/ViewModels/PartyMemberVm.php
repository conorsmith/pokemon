<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Index\ViewModels;

use ConorSmith\Pokemon\Gameplay\Domain\PartyMember;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\ViewModelFactory;

final class PartyMemberVm
{
    public static function create(PartyMember $partyMember): self
    {
        $config = require __DIR__ . "/../../../../../Config/Pokedex.php";

        $pokemonConfig = $config[$partyMember->pokedexNumber];

        return new self(
            $partyMember->id,
            $pokemonConfig['name'],
            $partyMember->form,
            match ($partyMember->sex) {
                Sex::FEMALE  => "fa-venus",
                Sex::MALE    => "fa-mars",
                Sex::UNKNOWN => "fa-genderless",
            },
            ViewModelFactory::createPokemonImageUrl($partyMember->pokedexNumber, $partyMember->form),
            strval($partyMember->level),
            $partyMember->isShiny,
        );
    }

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $form,
        public readonly string $sexIcon,
        public readonly string $imageUrl,
        public readonly string $level,
        public readonly bool $isShiny,
    ) {}
}