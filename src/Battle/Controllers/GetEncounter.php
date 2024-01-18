<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\ViewModels\TypeEffectiveness;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetEncounter
{
    public function __construct(
        private readonly PlayerRepositoryDb $playerRepository,
        private readonly EncounterRepository $encounterRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterId = $args['id'];

        $bag = $this->bagRepository->find();

        $encounter = $this->encounterRepository->find($encounterId);

        $pokeballs = [];

        foreach ($bag->getEachPokeBall() as $pokeBall) {
            $pokeballs[] = self::createPokeBallViewModel($pokeBall);
        }

        $player = $this->playerRepository->findPlayer();
        $playerLeadPokemon = $player->hasEntirePartyFainted()
            ? $player->getLastFaintedPokemon()
            : $player->getLeadPokemon();

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Encounter.php", [
            'id'                                          => $encounter->id,
            'encounteredPokemonIsRegistered'              => $encounter->isRegistered,
            'encounteredPokemonStrengthIndicatorProgress' => $encounter->strengthIndicatorProgress,
            'opponentPokemon'                             => $this->viewModelFactory->createPokemonInBattle($encounter->pokemon),
            'playerPokemon'                               => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'primaryTypeEffectiveness'                    => TypeEffectiveness::create("primary", $playerLeadPokemon, $encounter->pokemon),
            'secondaryTypeEffectiveness'                  => TypeEffectiveness::create("secondary", $playerLeadPokemon, $encounter->pokemon),
            'pokeballs'                                   => $pokeballs,
            'isLegendary'                                 => $encounter->isLegendary,
            'isBattleOver'                                => $encounter->pokemon->hasFainted || $encounter->wasCaught,
        ]));
    }

    private static function createPokeBallViewModel(Item $pokeBall): stdClass
    {
        $itemConfig = require __DIR__ . "/../../Config/Items.php";

        return (object) [
            'id'       => $pokeBall->id,
            'name'     => $itemConfig[$pokeBall->id]['name'],
            'imageUrl' => $itemConfig[$pokeBall->id]['imageUrl'],
            'amount'   => $pokeBall->quantity,
        ];
    }
}
