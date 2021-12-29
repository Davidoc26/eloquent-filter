<?php

declare(strict_types=1);

namespace Tests\Filters;

use Closure;
use Davidoc26\EloquentFilter\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

final class OrderByTestFilter extends Filter
{
    public function filter(Builder $builder, Closure $next): Builder|Closure
    {
        $builder->orderBy('id','desc');

        return $next($builder);
    }
}
