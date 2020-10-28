<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\Configuration\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void
{
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [__DIR__ . '/src', __DIR__ . '/config', __DIR__ . '/ecs.php']);

    $parameters->set(Option::SETS, [
        SetList::COMMON,
        SetList::CLEAN_CODE,
        SetList::DEAD_CODE,
        SetList::PSR_12,
        SetList::PHP_70,
        SetList::PHP_71,
        SetList::SYMPLIFY,
    ]);
};
