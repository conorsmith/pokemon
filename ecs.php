<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . "/convert.php",
        __DIR__ . "/download.php",
        __DIR__ . "/ecs.php",
        __DIR__ . "/generate.php",
        __DIR__ . "/import.php",
        __DIR__ . "/phinx.php",
        __DIR__ . "/simulate.php",
        __DIR__ . "/public",
        __DIR__ . "/src",
        __DIR__ . "/tests",
    ]);

    // this way you add a single rule
    $ecsConfig->rules([
        NoUnusedImportsFixer::class,
        \PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer::class,
    ]);

    // this way you can add sets - group of rules
    $ecsConfig->sets([
        // run and fix, one by one
        // SetList::SPACES,
        // SetList::ARRAY,
        // SetList::DOCBLOCK,
        // SetList::NAMESPACES,
        // SetList::COMMENTS,
        // SetList::PSR_12,
    ]);

    $ecsConfig->skip([
        \PhpCsFixer\Fixer\Whitespace\LineEndingFixer::class => ["*"],
        \PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer::class => ["*"],
    ]);
};
