<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\Battle;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\Domain\Player;
use ConorSmith\Pokemon\Battle\Domain\PlayerRepository;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\StartABattle;
use ConorSmith\Pokemon\SharedKernel\Commands\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\PokemonTest\Battle\Domain\BattleFactory;
use ConorSmith\PokemonTest\Battle\Domain\PokemonFactory;
use ConorSmith\PokemonTest\Battle\Domain\TrainerFactory;
use ConorSmith\PokemonTest\TestDouble;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class StartABattleTest extends TestCase
{
    #[Test]
    function start_a_battle_with_a_normal_trainer()
    {
        $useCase = new StartABattle(
            ($battleRepository = TestDouble::spy(BattleRepository::class))->reveal(),
            ($playerRepository = TestDouble::spy(PlayerRepository::class))->reveal(),
            ($trainerRepository = TestDouble::spy(TrainerRepository::class))->reveal(),
            TestDouble::dummy(ReportBattleWithGymLeaderCommand::class)->reveal(),
        );

        $battleRepository->findForTrainer("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(BattleFactory::create(
                id: "the battle id",
            ));

        $playerRepository->findPlayer()
            ->willReturn(new Player(
                [
                    PokemonFactory::create(
                        hasFainted: true,
                    ),
                ],
                [],
                null,
            ));

        $trainerRepository->findTrainerByTrainerId("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(TrainerFactory::any());

        $result = $useCase("00416693-3615-4116-b964-f4960d9387e3");

        assertThat(
            $result->succeeded(),
            isTrue(),
        );

        $playerRepository->savePlayer(
            Argument::that(function (Player $player) {
                return $player->activeBattleId === "the battle id"
                    && $player->party[0]->hasFainted === false;
            })
        )
            ->shouldHaveBeenCalled();

        $trainerRepository->saveTrainer(
            Argument::that(fn (Trainer $trainer) => $trainer->isBattling)
        )
            ->shouldHaveBeenCalled();
    }

    #[Test]
    function start_a_battle_with_a_normal_trainer_the_player_has_not_fought_before()
    {
        $useCase = new StartABattle(
            ($battleRepository = TestDouble::spy(BattleRepository::class))->reveal(),
            ($playerRepository = TestDouble::spy(PlayerRepository::class))->reveal(),
            ($trainerRepository = TestDouble::spy(TrainerRepository::class))->reveal(),
            TestDouble::dummy(ReportBattleWithGymLeaderCommand::class)->reveal(),
        );

        $battleRepository->find("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(null);

        $playerRepository->findPlayer()
            ->willReturn(new Player(
                [
                    PokemonFactory::create(
                        hasFainted: true,
                    ),
                ],
                [],
                null,
            ));

        $trainerRepository->findTrainerByTrainerId("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(TrainerFactory::any());

        $result = $useCase("00416693-3615-4116-b964-f4960d9387e3");

        assertThat(
            $result->succeeded(),
            isTrue(),
        );

        $battleRepository->save(
            Argument::that(function (Battle $battle) {
                return $battle->trainerId === "00416693-3615-4116-b964-f4960d9387e3"
                    && $battle->battleCount === 1
                    && $battle->dateLastBeaten === null;
            })
        )
            ->shouldHaveBeenCalled();

        $playerRepository->savePlayer(
            Argument::that(function (Player $player) {
                return $player->activeBattleId !== null
                    && $player->party[0]->hasFainted === false;
            })
        )
            ->shouldHaveBeenCalled();

        $trainerRepository->saveTrainer(
            Argument::that(fn (Trainer $trainer) => $trainer->isBattling)
        )
            ->shouldHaveBeenCalled();
    }

    #[Test]
    function start_a_battle_with_a_gym_leader()
    {
        $useCase = new StartABattle(
            ($battleRepository = TestDouble::spy(BattleRepository::class))->reveal(),
            ($playerRepository = TestDouble::spy(PlayerRepository::class))->reveal(),
            ($trainerRepository = TestDouble::spy(TrainerRepository::class))->reveal(),
            ($reportBattleWithGymLeaderCommand = TestDouble::spy(ReportBattleWithGymLeaderCommand::class))->reveal(),
        );

        $battleRepository->findForTrainer("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(BattleFactory::any());

        $playerRepository->findPlayer()
            ->willReturn(new Player(
                [
                    PokemonFactory::create(
                        id: "pokemon 1 id"
                    ),
                    PokemonFactory::create(
                        id: "pokemon 2 id"
                    ),
                    PokemonFactory::create(
                        id: "pokemon 3 id"
                    ),
                ],
                [],
                null,
            ));

        $trainerRepository->findTrainerByTrainerId("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(TrainerFactory::create(
                gymBadge: GymBadge::BOULDER,
            ));

        $result = $useCase("00416693-3615-4116-b964-f4960d9387e3");

        assertThat(
            $result->succeeded(),
            isTrue(),
        );

        $reportBattleWithGymLeaderCommand->run([
            "pokemon 1 id",
            "pokemon 2 id",
            "pokemon 3 id",
        ])
            ->shouldHaveBeenCalled();
    }

    #[Test]
    function start_a_battle_with_an_elite_four_member_or_equivalent_trainer()
    {
        $useCase = new StartABattle(
            ($battleRepository = TestDouble::spy(BattleRepository::class))->reveal(),
            ($playerRepository = TestDouble::spy(PlayerRepository::class))->reveal(),
            ($trainerRepository = TestDouble::spy(TrainerRepository::class))->reveal(),
            ($reportBattleWithGymLeaderCommand = TestDouble::spy(ReportBattleWithGymLeaderCommand::class))->reveal(),
        );

        $battleRepository->findForTrainer("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(BattleFactory::any());

        $playerRepository->findPlayer()
            ->willReturn(new Player(
                [
                    PokemonFactory::create(
                        id: "pokemon 1 id"
                    ),
                    PokemonFactory::create(
                        id: "pokemon 2 id"
                    ),
                    PokemonFactory::create(
                        id: "pokemon 3 id"
                    ),
                ],
                [],
                null,
            ));

        $trainerRepository->findTrainerByTrainerId("00416693-3615-4116-b964-f4960d9387e3")
            ->willReturn(TrainerFactory::create(
                class: TrainerClass::ELITE_FOUR,
            ));

        $result = $useCase("00416693-3615-4116-b964-f4960d9387e3");

        assertThat(
            $result->succeeded(),
            isTrue(),
        );

        $reportBattleWithGymLeaderCommand->run([
            "pokemon 1 id",
            "pokemon 2 id",
            "pokemon 3 id",
        ])
            ->shouldHaveBeenCalled();
    }
}
