<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\Trainer;
use LogicException;

final class ResultOfSimulatingABattle
{
    public static function draw(): self
    {
        return new self(true, null, null);
    }

    public static function victor(Trainer $winningTrainer, Trainer $losingTrainer): self
    {
        return new self(false, $winningTrainer, $losingTrainer);
    }

    private function __construct(
        public readonly bool $wasDraw,
        private readonly ?Trainer $winningTrainer,
        private readonly ?Trainer $losingTrainer,
    ) {}

    public function getWinningTrainer(): Trainer
    {
        if ($this->wasDraw) {
            throw new LogicException();
        }

        return $this->winningTrainer;
    }

    public function getLosingTrainer(): Trainer
    {
        if ($this->wasDraw) {
            throw new LogicException();
        }

        return $this->losingTrainer;
    }
}
