<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\UseCases;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;

final class SpendChallengeTokensUseCase
{
    public function __construct(
        private readonly BagRepository $bagRepository,
    ) {}

    public function __invoke(int $amount = 1): ResultOfSpendingChallengeTokens
    {
        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::CHALLENGE_TOKEN)) {
            return ResultOfSpendingChallengeTokens::failure();
        }

        $bag = $bag->use(ItemId::CHALLENGE_TOKEN);

        $this->bagRepository->save($bag);

        return ResultOfSpendingChallengeTokens::success();
    }
}
