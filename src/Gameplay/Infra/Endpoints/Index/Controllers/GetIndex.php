<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Index\Controllers;

use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Index\ViewModels\PartySlotVm;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\PartyMember;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Index\ViewModels\PartyMemberVm;
use ConorSmith\Pokemon\SharedKernel\Domain\Bag;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use LogicException;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetIndex
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly BagRepository $bagRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $bag = $this->bagRepository->find();

        $currentLocationConfig = $this->locationConfigRepository->findLocation(
            $this->locationRepository->findCurrentLocation()->id
        );

        $party = array_map(
            fn(Pokemon $pokemon) => new PartyMember(
                $pokemon->id,
                $pokemon->number,
                $pokemon->form,
                $pokemon->sex,
                $pokemon->level,
                $pokemon->isShiny,
            ),
            $this->pokemonRepository->getParty()->members,
        );

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Index.php", [
            'bagSummary' => self::createBagSummary($bag),
            'party'      => array_pad(
                    array_map(
                    fn(PartyMember $partyMember) => new PartySlotVm(
                        true,
                        PartyMemberVm::create($partyMember),
                    ),
                    $party
                ),
                6,
                new PartySlotVm(false, null),
            ),
            'location'   => (object) [
                'name'    => $currentLocationConfig['name'],
                'section' => $currentLocationConfig['section'] ?? "",
                'region'  => match ($currentLocationConfig['region']) {
                    RegionId::KANTO => "Kanto",
                    RegionId::JOHTO => "Johto",
                    RegionId::HOENN => "Hoenn",
                    default         => throw new LogicException(),
                }
            ]
        ]));
    }

    private static function createBagSummary(Bag $bag): stdClass
    {
        return (object) [
            'pokeBalls'       => $bag->countAllPokeBalls(),
            'rareCandy'       => $bag->count(ItemId::RARE_CANDY),
            'challengeTokens' => $bag->count(ItemId::CHALLENGE_TOKEN),
            'ovalCharms'      => $bag->count(ItemId::OVAL_CHARM),
        ];
    }
}
