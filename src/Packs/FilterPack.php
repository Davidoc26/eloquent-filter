<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Packs;

abstract class FilterPack
{
    abstract public function getFilters(): array;
}
