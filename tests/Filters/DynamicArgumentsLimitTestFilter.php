<?php

declare(strict_types=1);

namespace Tests\Filters;

use Closure;
use Davidoc26\EloquentFilter\Filters\RequestFilter;
use Davidoc26\EloquentFilter\Traits\HasArguments;
use Illuminate\Database\Eloquent\Builder;

final class DynamicArgumentsLimitTestFilter extends RequestFilter
{
    use HasArguments;

    public function filter(Builder $builder, Closure $next): Builder
    {
        $builder->limit($this->limit);

        return $next($builder);
    }

}
