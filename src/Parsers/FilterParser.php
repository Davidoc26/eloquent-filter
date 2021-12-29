<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Parsers;

use function array_unique;
use function is_array;
use function is_string;
use const SORT_REGULAR;

final class FilterParser
{
    private ParsedFilterCollection $parsedFilterCollection;

    private function __construct(private array $filters)
    {
        $this->parsedFilterCollection = new ParsedFilterCollection();
    }

    public static function createFromFilters(array $filters): self
    {
        $filters = array_unique($filters, SORT_REGULAR);

        return new self($filters);
    }

    public function parse(): ParsedFilterCollection
    {
        foreach ($this->filters as $filter => $arguments) {
            $parsedFilter = $this->generateParsedFilter($filter, $arguments);
            $this->parsedFilterCollection->add($parsedFilter);
        }

        return $this->parsedFilterCollection;
    }

    public function generateParsedFilter(mixed $filter, mixed $arguments): ParsedFilter
    {
        if ($this->hasArguments($filter)) {
            return new ParsedFilter($filter, is_array($arguments) ? $arguments : [$arguments]);
        }

        return new ParsedFilter($arguments);
    }

    protected function hasArguments(mixed $filter): bool
    {
        if (is_string($filter)) {
            return true;
        }

        return false;
    }
}
