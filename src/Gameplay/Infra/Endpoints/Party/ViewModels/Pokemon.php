<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon as DomainModel;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\ViewModelFactory;
use LogicException;
use stdClass;

final class Pokemon
{
    public static function create(DomainModel $pokemon): self
    {
        $config = require __DIR__ . "/../../../../../Config/Pokedex.php";

        $itemConfigRepository = new ItemConfigRepository();

        $pokemonConfig = $config[$pokemon->number];
        if ($pokemon->isHoldingAnItem()) {
            $itemConfig = $itemConfigRepository->find($pokemon->heldItemId);
        }

        return new self(
            $pokemon->id,
            $pokemonConfig['name'],
            $pokemon->form,
            match ($pokemon->sex) {
                Sex::FEMALE  => "fa-venus",
                Sex::MALE    => "fa-mars",
                Sex::UNKNOWN => "fa-genderless",
            },
            ViewModelFactory::createPokemonImageUrl($pokemon->number, $pokemon->form),
            ViewModelFactory::createPokemonTypeName($pokemonConfig['type'][0]),
            isset($pokemonConfig['type'][1]) ? ViewModelFactory::createPokemonTypeName($pokemonConfig['type'][1]) : null,
            strval($pokemon->level),
            strval($pokemon->friendship),
            match (true) {
                $pokemon->friendship === 255 => "fa-laugh-beam",
                $pokemon->friendship >= 220  => "fa-grin-beam",
                $pokemon->friendship >= 200  => "fa-smile-beam",
                $pokemon->friendship >= 150  => "fa-laugh",
                $pokemon->friendship >= 100  => "fa-smile",
                $pokemon->friendship >= 50   => "fa-meh",
                $pokemon->friendship > 0     => "fa-frown",
                $pokemon->friendship === 0   => "fa-angry",
                default                      => throw new LogicException(),
            },
            $pokemon->isShiny,
            $pokemon->isHoldingAnItem(),
            $pokemon->isHoldingAnItem() ? self::createHeldItemVm($itemConfig) : null,
        );
    }

    private static function createHeldItemVm(array $itemConfig): stdClass
    {
        return (object) [
            'name'     => $itemConfig['name'],
            'imageUrl' => $itemConfig['imageUrl'],
        ];
    }

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $form,
        public readonly string $sexIcon,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly ?string $secondaryType,
        public readonly string $level,
        public readonly string $friendship,
        public readonly string $friendshipIcon,
        public readonly bool $isShiny,
        public readonly bool $isHoldingAnItem,
        public readonly ?stdClass $heldItem,
    ) {}
}
