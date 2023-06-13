<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\EliteFourChallengeTeamMember;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetHallOfFame
{
    public function __construct(
        private readonly Session $session,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $region = RegionId::tryFrom(strtoupper($args['region']));

        if (is_null($region)) {
            $this->session->getFlashBag()->add("errors", "Unknown region");
            header("Location: /map");
            return;
        }

        $eliteFourChallenge = $this->eliteFourChallengeRepository->findVictoryInRegion($region);

        $teamViewModels = [];

        /** @var EliteFourChallengeTeamMember $member */
        foreach ($eliteFourChallenge->team as $member) {
            $pokedexConfig = $this->pokedexConfigRepository->find($member->pokedexNumber);
            $teamViewModels[$member->pokedexNumber] = (object) [
                'name'     => $pokedexConfig['name'],
                'imageUrl' => TeamMember::createImageUrl($member->pokedexNumber, $member->form),
                'primaryType' => ViewModelFactory::createPokemonTypeName($pokedexConfig['type'][0]),
                'secondaryType' => isset($pokedexConfig['type'][1])
                    ? ViewModelFactory::createPokemonTypeName($pokedexConfig['type'][1])
                    : null,
                'level'    => $member->level,
                // TODO - Check caught pokemon to see if this one is shiny
                'isShiny'  => false,
            ];
        }

        ksort($teamViewModels);

        echo $this->templateEngine->render(__DIR__ . "/../Templates/HallOfFame.php", [
            'team' => $teamViewModels,
        ]);
    }
}