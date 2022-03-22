<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Handlers;

use Closure;
use Davidoc26\EloquentFilter\Exceptions\ArgumentsNotSpecifiedException;
use Davidoc26\EloquentFilter\Filters\FilterInterface;
use Davidoc26\EloquentFilter\Util;
use Illuminate\Database\Eloquent\Builder;

final class FilterHandler implements HandlerInterface
{
    public function handle(FilterInterface $filter, Builder $builder, Closure $stack, ?array $arguments = null): Builder
    {
        if (Util::hasArguments($filter)) {
            /**
             * @psalm-suppress UndefinedMethod
             */
            $filter->setArguments($arguments ?? throw new ArgumentsNotSpecifiedException(sprintf("The filter %s must have arguments, but nothing is passed", get_class($filter))));
        }

        return $filter->filter($builder, $stack);
    }
}
