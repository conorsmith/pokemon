<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Index\ViewModels;

final class PartySlotVm
{
    public function __construct(
        public readonly bool $hasMember,
        public readonly ?PartyMemberVm $member,
    ) {}
}
