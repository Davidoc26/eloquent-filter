<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Handlers;

use Closure;
use Davidoc26\EloquentFilter\Filters\FilterInterface;
use Davidoc26\EloquentFilter\Util;
use Illuminate\Database\Eloquent\Builder;

final class FilterHandler implements HandlerInterface
{
    public function handle(FilterInterface $filter, Builder $builder, Closure $stack, ?array $arguments): Builder
    {
        if (Util::hasArguments($filter)) {
            /**
             * @psalm-suppress UndefinedMethod
             */
            $filter->setArguments($arguments);
        }

        return $filter->filter($builder, $stack);
    }
}
