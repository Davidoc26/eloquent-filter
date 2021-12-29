<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    abstract public function filter(Builder $builder, Closure $next): Builder|Closure;
}