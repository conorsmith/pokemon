<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

final class PostItemUse
{
    public function __invoke(array $args): void
    {
        $itemId = $args['id'];

        header("Location: /team/use/{$itemId}");
    }
}
