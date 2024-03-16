<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallenge;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengePartyMember;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetHallOfFame
{
    public function __construct(
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $region = RegionId::tryFrom(strtoupper($args['region']));

        if (is_null($region)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Unknown region")
            );
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $eliteFourChallenges = $this->eliteFourChallengeRepository->findAllVictoriesInRegion($region);

        $hallOfFameEntries = [];

        /** @var EliteFourChallenge $eliteFourChallenge */
        foreach ($eliteFourChallenges as $eliteFourChallenge) {

            $partyViewModels = [];

            /** @var EliteFourChallengePartyMember $member */
            foreach ($eliteFourChallenge->party as $member) {
                $pokedexConfig = $this->pokedexConfigRepository->find($member->pokedexNumber);
                $partyViewModels[$member->pokedexNumber] = (object) [
                    'name'          => $pokedexConfig['name'],
                    'imageUrl'      => ViewModelFactory::createPokemonImageUrl($member->pokedexNumber, $member->form),
                    'primaryType'   => ViewModelFactory::createPokemonTypeName($pokedexConfig['type'][0]),
                    'secondaryType' => isset($pokedexConfig['type'][1])
                        ? ViewModelFactory::createPokemonTypeName($pokedexConfig['type'][1])
                        : null,
                    'level'         => $member->level,
                    // TODO - Check caught pokemon to see if this one is shiny
                    'isShiny'       => false,
                ];
            }

            ksort($partyViewModels);

            $hallOfFameEntries[] = (object) [
                // TODO - Get the trainer name and more info from config
                'name'  => $eliteFourChallenge->isPlayerTheChallenger() ? "Player" : "Trainer",
                'date'  => $eliteFourChallenge->dateCompleted->format("F jS, Y"),
                'party' => $partyViewModels,
            ];
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/HallOfFame.php", [
            'hallOfFameEntries' => $hallOfFameEntries,
        ]));
    }
}