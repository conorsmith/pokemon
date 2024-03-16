<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Surveying;

use Carbon\CarbonImmutable;
use DateTimeImmutable;
use LogicException;
use Ramsey\Uuid\Uuid;

final class Survey
{
    public static function blank(string $locationId, string $encounterType): self
    {
        return new self(
            Uuid::uuid4()->toString(),
            $locationId,
            $encounterType,
            false,
            false,
            CarbonImmutable::now("Europe/Dublin"),
            0,
            [],
        );
    }

    private readonly SurveyResultsCache $sortedResultsCache;
    private readonly SurveyResultsCache $indexedResultsCache;

    public function __construct(
        public readonly string $id,
        public readonly string $locationId,
        public readonly string $encounterType,
        public readonly bool $isComplete,
        public readonly bool $inProgress,
        public readonly DateTimeImmutable $startedAt,
        public readonly int $cumulativeTime,
        public readonly array $results,
    ) {
        $this->sortedResultsCache = new SurveyResultsCache();
        $this->indexedResultsCache = new SurveyResultsCache();
    }

    public function start(): self
    {
        return new self(
            $this->id,
            $this->locationId,
            $this->encounterType,
            $this->isComplete,
            true,
            CarbonImmutable::now("Europe/Dublin"),
            $this->cumulativeTime,
            $this->results,
        );
    }

    public function finish(): self
    {
        return new self(
            $this->id,
            $this->locationId,
            $this->encounterType,
            $this->isComplete,
            false,
            $this->startedAt,
            $this->cumulativeTime + $this->currentDuration(),
            $this->results,
        );
    }

    public function complete(): self
    {
        return new self(
            $this->id,
            $this->locationId,
            $this->encounterType,
            true,
            $this->inProgress,
            $this->startedAt,
            $this->cumulativeTime,
            $this->results,
        );
    }

    public function overwriteResults(array $results): self
    {
        return new self(
            $this->id,
            $this->locationId,
            $this->encounterType,
            $this->isComplete,
            $this->inProgress,
            $this->startedAt,
            $this->cumulativeTime,
            $results,
        );
    }

    public function addEncounter(string $pokedexNumber, ?string $form): self
    {
        if (!$this->inProgress) {
            throw new LogicException();
        }

        $newSurveyResults = [];

        $added = false;

        /** @var SurveyResult $surveyResult */
        foreach ($this->results as $surveyResult) {
            if ($surveyResult->pokedexNumber === $pokedexNumber
                && $surveyResult->form === $form
            ) {
                $newSurveyResults[] = $surveyResult->addSighting();
                $added = true;
            } else {
                $newSurveyResults[] = $surveyResult;
            }
        }

        if ($added === false) {
            $newSurveyResults[] = new SurveyResult(
                $pokedexNumber,
                $form,
                1,
            );
        }

        return new self(
            $this->id,
            $this->locationId,
            $this->encounterType,
            $this->isComplete,
            $this->inProgress,
            $this->startedAt,
            $this->cumulativeTime,
            $newSurveyResults,
        );
    }

    public function hasResults(): bool
    {
        return count($this->results) > 0;
    }

    public function findResult(string $pokedexNumber, ?string $form): ?SurveyResult
    {
        $indexedResults = $this->getIndexedResults();

        if (!array_key_exists($pokedexNumber, $indexedResults)
            || !array_key_exists($form, $indexedResults[$pokedexNumber])
        ) {
            return null;
        }

        return $indexedResults[$pokedexNumber][$form];
    }

    private function getIndexedResults(): array
    {
        if ($this->indexedResultsCache->isSet()) {
            return $this->indexedResultsCache->get();
        }

        $indexedResults = [];

        /** @var SurveyResult $result */
        foreach ($this->results as $result) {

            if (!array_key_exists($result->pokedexNumber, $indexedResults)) {
                $indexedResults[$result->pokedexNumber] = [];
            }

            if (array_key_exists($result->form, $indexedResults[$result->pokedexNumber])) {
                throw new LogicException();
            }

            $indexedResults[$result->pokedexNumber][$result->form] = $result;
        }

        $this->indexedResultsCache->set($indexedResults);

        return $this->indexedResultsCache->get();
    }

    public function getMostSightings(): int
    {
        $results = $this->getSortedResultsFromMostSighted();

        return $results[0]->sightings;
    }

    public function getSortedResultsFromMostSighted(): array
    {
        if ($this->sortedResultsCache->isSet()) {
            return $this->sortedResultsCache->get();
        }

        $sortedResults = $this->results;

        usort(
            $sortedResults,
            fn(SurveyResult $resultA, SurveyResult $resultB) => $resultA->sightings < $resultB->sightings ? 1 : -1,
        );

        $this->sortedResultsCache->set($sortedResults);

        return $this->sortedResultsCache->get();
    }

    public function currentDuration(): int
    {
        if (!$this->inProgress) {
            throw new LogicException();
        }

        $now = CarbonImmutable::now("Europe/Dublin");
        $startedAt = new CarbonImmutable($this->startedAt);

        return $now->diffInRealSeconds($startedAt);
    }

    public function countEncountersInCurrentSession(): int
    {
        if (!$this->inProgress) {
            throw new LogicException();
        }

        return intval(floor($this->currentDuration() / 5));
    }

    public function matches(self $other): bool
    {
        $mostOtherSightings = $other->getMostSightings();
        $mostSightings = $this->getMostSightings();

        /** @var SurveyResult $otherResult */
        foreach ($other->results as $otherResult) {

            $thisResult = $this->findResult($otherResult->pokedexNumber, $otherResult->form);

            if (is_null($thisResult)) {
                return false;
            }

            $otherRate = $otherResult->sightings / $mostOtherSightings;
            $thisRate = $thisResult->sightings / $mostSightings;

            $roundedOtherRate = round($otherRate * 20);
            $roundedThisRate = round($thisRate * 20);

            if ($roundedOtherRate !== $roundedThisRate) {
                return false;
            }

            if ($thisResult->sightings < $roundedOtherRate * 10) {
                return false;
            }
        }

        return true;
    }
}
