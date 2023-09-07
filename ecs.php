<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . "/console.php",
        __DIR__ . "/ecs.php",
        __DIR__ . "/phinx.php",
        __DIR__ . "/public",
        __DIR__ . "/src",
        __DIR__ . "/tests",
    ]);

    // this way you add a single rule
    $ecsConfig->rules([
        NoUnusedImportsFixer::class,
    ]);

    // this way you can add sets - group of rules
    $ecsConfig->sets([
        // run and fix, one by one
        // SetList::SPACES,
        // SetList::ARRAY,
        // SetList::DOCBLOCK,
        SetList::NAMESPACES,
        // SetList::COMMENTS,
        // SetList::PSR_12,
    ]);

    $ecsConfig->ruleWithConfiguration(\PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer::class, [
        'operators' => [
            '=>' => 'align_single_space_minimal_by_scope',
        ],
    ]);

    $ecsConfig->ruleWithConfiguration(\PhpCsFixer\Fixer\Import\OrderedImportsFixer::class, [
        'imports_order' => ['class', 'const', 'function'],
    ]);
};
