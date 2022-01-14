<?php

declare(strict_types=1);

namespace Tests\FilterPacks;

use Davidoc26\EloquentFilter\Packs\FilterPack;
use Tests\Filters\ArgumentsLimitTestFilter;
use Tests\Filters\OrderByTestFilter;

final class TestFilterPack extends FilterPack
{
    public function getFilters(): array
    {
        return [
            ArgumentsLimitTestFilter::class => ['limit' => 5],
            OrderByTestFilter::class,
        ];
    }
}
