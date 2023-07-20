<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

use Exception;

final class RandomNumberGenerator
{
    public static function setSeed(int $seedValue): void
    {
        mt_srand($seedValue);
    }

    public static function unsetSeed(): void
    {
        mt_srand();
    }

    public static function generateInRange(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }

    public static function coinToss(): bool
    {
        return self::generateInRange(0, 1) === 0;
    }

    public static function generateFromWeightedTable(array $weights): int
    {
        $sumOfWeights = array_reduce($weights, function ($carry, $weight) {
            return $carry + $weight;
        }, 0);

        $generatedValue = mt_rand(1, $sumOfWeights);

        foreach ($weights as $number => $weight) {
            $generatedValue -= $weight;

            if ($generatedValue <= 0) {
                return $number;
            }
        }

        throw new Exception;
    }
}
