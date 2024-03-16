<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\InGameEvents;

interface FixedEncounterCaptureEventRepository
{
    public function save(FixedEncounterCaptureEvent $legendaryCaptureEvent): void;

    public function findForPokemonInReverseChronologicalOrder(string $fixedEncounterId): array;
}