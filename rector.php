<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(TypedPropertyFromStrictConstructorRector::class);

    $rectorConfig->paths([
        __DIR__.'/app/Livewire',
        __DIR__.'/app/Models',
        __DIR__.'/app/Http',
        __DIR__.'/app/Support',
        __DIR__.'/app/Traits',
        __DIR__.'/app/View',
        __DIR__.'/app/Enums',
        __DIR__.'/resources',
    ]);
    // register a single rule
    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
        SetList::PHP_80,
        SetList::PHP_81,
        SetList::PHP_82,
        SetList::EARLY_RETURN,
    ]);
};
