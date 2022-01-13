<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Handlers;

use Closure;
use Davidoc26\EloquentFilter\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

interface HandlerInterface
{
    public function handle(FilterInterface $filter, Builder $builder, Closure $stack, ?array $arguments): Builder;
}
