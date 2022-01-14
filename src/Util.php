<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter;

use Davidoc26\EloquentFilter\Filters\FilterInterface;
use Davidoc26\EloquentFilter\Packs\FilterPack;
use Davidoc26\EloquentFilter\Traits\HasArguments;
use Illuminate\Contracts\Container\BindingResolutionException;
use function app;
use function class_uses;

final class Util
{
    public static function hasArguments(FilterInterface $filter): bool
    {
        $traits = class_uses($filter);

        foreach ($traits as $trait) {
            if ($trait === HasArguments::class) {
                return true;
            }
        }

        return false;
    }

    /**
     * @throws BindingResolutionException
     */
    public static function initFilterPack(string $pack): FilterPack
    {
        return app()->make($pack);
    }

}
