<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;

final class GetEncounter
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly EncounterRepository $encounterRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $encounterId = $args['id'];

        $bag = $this->bagRepository->find();

        $encounter = $this->encounterRepository->find($encounterId);

        $pokeballs = [];

        foreach ($bag->getEachPokeBall() as $pokeBall) {
            $pokeballs[] = self::createPokeBallViewModel($pokeBall);
        }

        $player = $this->playerRepository->findPlayer();
        $playerLeadPokemon = $player->hasEntireTeamFainted()
            ? $player->getLastFaintedPokemon()
            : $player->getLeadPokemon();

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Encounter.php", [
            'id' => $encounter->id,
            'encounteredPokemonIsRegistered' => $encounter->isRegistered,
            'opponentPokemon' => $this->viewModelFactory->createPokemonInBattle($encounter->pokemon),
            'playerPokemon' => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'pokeballs' => $pokeballs,
            'isLegendary' => $encounter->isLegendary,
            'isBattleOver' => $encounter->pokemon->hasFainted || $encounter->wasCaught,
        ]);
    }

    private static function createPokeBallViewModel(Item $pokeBall): stdClass
    {
        $itemConfig = require __DIR__ . "/../../Config/Items.php";

        return (object) [
            'id' => $pokeBall->id,
            'name' => $itemConfig[$pokeBall->id]['name'],
            'imageUrl' => $itemConfig[$pokeBall->id]['imageUrl'],
            'amount' => $pokeBall->quantity,
        ];
    }
}
