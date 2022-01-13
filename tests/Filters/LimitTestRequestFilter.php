<?php

declare(strict_types=1);

namespace Tests\Filters;

use Closure;
use Davidoc26\EloquentFilter\Filters\RequestFilter;
use Illuminate\Database\Eloquent\Builder;

final class LimitTestRequestFilter extends RequestFilter
{
    public function filter(Builder $builder, Closure $next): Builder
    {
        $builder->when(
            $this->request->input('limit', false),
            function (Builder $builder, string $limit) {
                $builder->limit($limit);
            });

        return $next($builder);
    }
}
