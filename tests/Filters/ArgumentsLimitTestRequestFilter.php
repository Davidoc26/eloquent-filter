<?php

namespace Tests\Filters;

use Closure;
use Davidoc26\EloquentFilter\Filters\RequestFilter;
use Davidoc26\EloquentFilter\Traits\HasArguments;
use Illuminate\Database\Eloquent\Builder;

final class ArgumentsLimitTestRequestFilter extends RequestFilter
{
    use HasArguments;

    public function filter(Builder $builder, Closure $next): Builder
    {
        $builder->when(
        // If there is no limit in the request, we take from the one specified in getFilters()
            $this->request->get('limit', $this->getArguments()['limit']),
            fn(Builder $builder, string|int $limit) => $builder->limit($limit)
        );

        return $next($builder);
    }
}