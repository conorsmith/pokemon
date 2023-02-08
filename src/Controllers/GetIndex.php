<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Bag;
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
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();
        $team = $this->pokemonRepository->getTeam();

        $successes = $this->session->getFlashBag()->get("successes");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Index.php", [
            'bagSummary' => self::createBagSummary($bag),
            'team' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $team->members
            ),
            'badges' => array_map(
                fn(int $value) => $this->viewModelFactory->createGymBadge(GymBadge::from($value)),
                json_decode($instanceRow['badges'])
            ),
            'successes' => $successes,
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
