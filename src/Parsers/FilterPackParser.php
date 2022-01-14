<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Parsers;

use Davidoc26\EloquentFilter\Packs\FilterPack;
use Davidoc26\EloquentFilter\Util;
use function array_merge;

final class FilterPackParser
{
    /**
     * @var FilterPack[] $filterPacks
     */
    private array $filterPacks = [];

    private function __construct()
    {
    }

    public static function createFromPacks(array $filterPacks): self
    {
        $parser = new self();
        foreach ($filterPacks as $filterPack) {
            $parser->filterPacks[] = Util::initFilterPack($filterPack);
        }

        return $parser;
    }

    public function parse(): array
    {
        $filters = [];
        foreach ($this->filterPacks as $filterPack) {
            foreach ($filterPack->getFilters() as $filter => $argument) {
                $filters = array_merge($filters, [$filter => $argument]);
            }
        }

        return $filters;
    }
}
