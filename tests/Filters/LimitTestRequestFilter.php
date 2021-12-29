<?php

declare(strict_types=1);

namespace Tests\Filters;

use Closure;
use Davidoc26\EloquentFilter\Filters\RequestFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class LimitTestRequestFilter extends RequestFilter
{
    public function filter(Builder $builder, Request $request, Closure $next): Builder|Closure
    {
        $builder->when(
            $request->input('limit', false),
            function (Builder $builder, string $limit) {
                $builder->limit($limit);
            });

        return $next($builder);
    }
}
