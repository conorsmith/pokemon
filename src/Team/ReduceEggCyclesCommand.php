<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\CurrentLocationQuery;
use ConorSmith\Pokemon\SharedKernel\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\ReduceEggCyclesCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\Team\Domain\Egg;
use ConorSmith\Pokemon\Team\Domain\EggRepository;
use ConorSmith\Pokemon\Team\Domain\GenealogyRepository;
use ConorSmith\Pokemon\Team\Domain\ParentalRelationship;
use ConorSmith\Pokemon\Team\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Team\ViewModels\BreedingPokemon;
use Exception;
use Symfony\Component\HttpFoundation\Session\Session;

final class ReduceEggCyclesCommand implements CommandInterface
{
    public function __construct(
        private readonly Session $session,
        private readonly EggRepository $eggRepository,
        private readonly GenealogyRepository $genealogyRepository,
        private readonly AddNewPokemon $addNewPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly CurrentLocationQuery $currentLocationQuery,
        private readonly TotalRegisteredPokemonQuery $totalRegisteredPokemonQuery,
    ) {}

    public function run(int $amount): void
    {
        $eggs = $this->eggRepository->all();

        /** @var Egg $egg */
        foreach ($eggs as $egg) {
            $this->updateEgg($egg, $amount);
        }
    }

    private function updateEgg(Egg $egg, int $amount): void
    {
        $egg = $egg->reduceCycles($amount);

        if (!$egg->canHatch()) {
            $this->eggRepository->save($egg);
            return;
        }

        $totalRegisteredPokemonBeforeHatching = $this->totalRegisteredPokemonQuery->run();

        $pokemon = $this->addNewPokemon->run(
            $egg->pokedexNumber,
            $egg->form,
            5,
            $this->generateSex($egg->pokedexNumber),
            $this->generateShininess(),
            $egg->ivHp,
            $egg->ivPhysicalAttack,
            $egg->ivPhysicalDefence,
            $egg->ivSpecialAttack,
            $egg->ivSpecialDefence,
            $egg->ivSpeed,
            $this->currentLocationQuery->run(),
            null,
        );

        $this->genealogyRepository->add(new ParentalRelationship(
            $pokemon->id,
            $egg->firstParentId,
            $egg->secondParentId,
        ));

        $this->eggRepository->remove($egg);

        $totalRegisteredPokemonAfterHatching = $this->totalRegisteredPokemonQuery->run();

        $pokemonVm = BreedingPokemon::create($pokemon);
        $this->session->getFlashBag()->add("successes", "{$pokemonVm->name} hatched from an egg!");

        if ($totalRegisteredPokemonAfterHatching > $totalRegisteredPokemonBeforeHatching) {
            $this->session->getFlashBag()->add("successes", "{$pokemonVm->name} has been registered in your Pokédex");
        }
    }

    private function generateSex(string $pokedexNumber): Sex
    {
        $pokedexConfig = $this->pokedexConfigRepository->find($pokedexNumber);

        if (count($pokedexConfig['sexRatio']) === 1) {
            return $pokedexConfig['sexRatio'][0]['sex'];
        }

        return self::randomlySelectSex($pokedexConfig['sexRatio']);
    }

    private static function randomlySelectSex(array $sexRatioConfig): Sex
    {
        $aggregatedWeight = array_reduce(
            $sexRatioConfig,
            function ($carry, array $sexRatioEntry) {
                return $carry + $sexRatioEntry['weight'];
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var array $sexRatioEntry */
        foreach ($sexRatioConfig as $sexRatioEntry) {
            $randomlySelectedValue -= $sexRatioEntry['weight'];
            if ($randomlySelectedValue <= 0) {
                return $sexRatioEntry['sex'];
            }
        }

        throw new Exception;
    }

    private function generateShininess(): bool
    {
        $streak = $this->habitStreakQuery->run();

        $divisor = $streak < 7 ? self::curveBeforeOneWeek($streak) : self::curveAfterOneWeek($streak);

        $odds = intval(round(4096 / $divisor));

        return mt_rand(1, $odds) === 1;
    }

    private static function curveBeforeOneWeek(int $i): float
    {
        return 0.480898 * log(8 * ($i + 1));
    }

    private static function curveAfterOneWeek(int $i): float
    {
        return 3.54073 * log(0.251313 * $i);
    }
}
