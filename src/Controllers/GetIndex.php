<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Bag;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetIndex
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokemonRepository $pokemonRepository,
        private readonly BagRepository $bagRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();
        $team = $this->pokemonRepository->getTeam();

        $currentPokemonLeague = $this->eliteFourChallengeRepository->findCurrentPokemonLeagueRegion();

        $regionalBadgeIdOffset = match($currentPokemonLeague) {
            Region::KANTO => 0,
            Region::JOHTO => 8,
            Region::HOENN => 16,
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

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Index.php", [
            'bagSummary' => self::createBagSummary($bag),
            'team' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $team->members
            ),
            'currentPokemonLeague' => match($currentPokemonLeague) {
                Region::KANTO => "Kanto",
                Region::JOHTO => "Johto",
                Region::HOENN => "Hoenn",
            },
            'badges' => $badgeViewModels,
        ]);
    }

    private static function createBagSummary(Bag $bag): stdClass
    {
        return (object) [
            'pokeBalls' => $bag->countAllPokeBalls(),
            'rareCandy' => $bag->count(ItemId::RARE_CANDY),
            'challengeTokens' => $bag->count(ItemId::CHALLENGE_TOKEN),
            'other' => $bag->countAllItems()
                - $bag->countAllPokeBalls()
                - $bag->count(ItemId::RARE_CANDY)
                - $bag->count(ItemId::CHALLENGE_TOKEN),
        ];
    }
}
