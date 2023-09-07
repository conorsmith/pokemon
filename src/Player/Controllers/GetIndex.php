<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player\Controllers;

use ConorSmith\Pokemon\Player\Domain\PartyMember;
use ConorSmith\Pokemon\Player\ViewModels\PartyMemberVm;
use ConorSmith\Pokemon\SharedKernel\Domain\Bag;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryParameters;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryProperty;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryResult;
use ConorSmith\Pokemon\SharedKernel\Queries\CurrentPokemonLeagueQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use LogicException;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetIndex
{
    public function __construct(
        private readonly Connection $db,
        private readonly CapturedPokemonQuery $capturedPokemonQuery,
        private readonly BagRepository $bagRepository,
        private readonly CurrentPokemonLeagueQuery $currentPokemonLeagueQuery,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $args['instanceId'],
        ]);

        $bag = $this->bagRepository->find();

        $party = array_map(
            fn (CapturedPokemonQueryResult $queryResult) => new PartyMember(
                $queryResult->id,
                $queryResult->pokedexNumber,
                $queryResult->get(CapturedPokemonQueryProperty::FORM),
                $queryResult->get(CapturedPokemonQueryProperty::SEX),
                $queryResult->get(CapturedPokemonQueryProperty::LEVEL),
                $queryResult->get(CapturedPokemonQueryProperty::IS_SHINY),
            ),
            $this->capturedPokemonQuery->run(CapturedPokemonQueryParameters::partyMembers([
                CapturedPokemonQueryProperty::FORM,
                CapturedPokemonQueryProperty::SEX,
                CapturedPokemonQueryProperty::LEVEL,
                CapturedPokemonQueryProperty::IS_SHINY,
            ])),
        );

        $currentPokemonLeague = $this->currentPokemonLeagueQuery->run();

        $regionalBadgeIdOffset = match($currentPokemonLeague) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 8,
            RegionId::HOENN => 16,
            default         => throw new LogicException(),
        };

        $earnedBadgeIds = json_decode($instanceRow['badges']);

        $badgeViewModels = [];

        for ($i = 1; $i <= 8; $i++) {
            $badgeId = $i + $regionalBadgeIdOffset;
            if (in_array($badgeId, $earnedBadgeIds)) {
                $badgeViewModels[] = $this->viewModelFactory->createGymBadge(GymBadge::from($badgeId));
            } else {
                $badgeViewModels[] = null;
            }
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Index.php", [
            'bagSummary'           => self::createBagSummary($bag),
            'party'                => array_map(
                fn(PartyMember $partyMember) => PartyMemberVm::create($partyMember),
                $party
            ),
            'currentPokemonLeague' => match($currentPokemonLeague) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
                default         => throw new LogicException(),
            },
            'badges'               => $badgeViewModels,
        ]));
    }

    private static function createBagSummary(Bag $bag): stdClass
    {
        return (object) [
            'pokeBalls'       => $bag->countAllPokeBalls(),
            'rareCandy'       => $bag->count(ItemId::RARE_CANDY),
            'challengeTokens' => $bag->count(ItemId::CHALLENGE_TOKEN),
        ];
    }
}
