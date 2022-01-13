<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function filter(Builder $builder, Closure $next): Builder;
}
