<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Traits;

use Davidoc26\EloquentFilter\Parsers\FilterParser;
use Davidoc26\EloquentFilter\Pipeline;
use Illuminate\Database\Eloquent\Builder;
use function array_merge;

trait Filterable
{
    public function scopeFilter(Builder $builder, $additionalFilters = []): Builder
    {
        $filters = array_merge($this->getFilters(), $additionalFilters);

        $filters = FilterParser::createFromFilters($filters)->parse();

        return (new Pipeline())
            ->send($builder)
            ->through($filters)
            ->thenReturn();
    }

    public function scopeWithFilters(Builder $builder, array $filters): Builder
    {
        $filters = FilterParser::createFromFilters($filters)->parse();

        return (new Pipeline())
            ->send($builder)
            ->through($filters)
            ->thenReturn();
    }

    public function getFilters(): array
    {
        return [];
    }
}
