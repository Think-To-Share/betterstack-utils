<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php82: true)
    ->withPreparedSets(typeDeclarations: true, deadCode: true, earlyReturn: true)
    ->withRules([
        InlineConstructorDefaultToPropertyRector::class,
        DeclareStrictTypesRector::class,
        CompactToVariablesRector::class,
    ]);
