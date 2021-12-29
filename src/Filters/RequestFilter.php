<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class RequestFilter
{
    abstract public function filter(Builder $builder, Request $request, Closure $next): Builder|Closure;
}
