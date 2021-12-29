<?php

declare(strict_types=1);

namespace Tests\Filters;

use Closure;
use Davidoc26\EloquentFilter\Filters\Filter;
use Davidoc26\EloquentFilter\Traits\HasArguments;
use Illuminate\Database\Eloquent\Builder;

final class ArgumentsLimitTestFilter extends Filter
{
    use HasArguments;

    public function filter(Builder $builder, Closure $next): Builder|Closure
    {
        $limit = $this->getArguments()['limit'];

        $builder->limit($limit);

        return $next($builder);
    }

}
