<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Surveying;

use LogicException;

final class SurveyResultsCache
{
    private array $cachedValue;

    public function set(array $cachedValue): void
    {
        if ($this->isSet()) {
            throw new LogicException("SurveyResultCache can only be set once");
        }

        $this->cachedValue = $cachedValue;
    }

    public function isSet(): bool
    {
        return isset($this->cachedValue);
    }

    public function get(): array
    {
        if (!$this->isSet()) {
            throw new LogicException("SurveyResultCache has not been set");
        }

        return $this->cachedValue;
    }
}
