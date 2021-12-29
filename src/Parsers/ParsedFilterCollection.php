<?php

namespace Davidoc26\EloquentFilter\Parsers;

final class ParsedFilterCollection
{
    /**
     * @var ParsedFilter[]
     */
    private array $filters;

    public function __construct(ParsedFilter ...$filters)
    {
        $this->filters = $filters;
    }

    public function add(ParsedFilter $filter): void
    {
        $this->filters[] = $filter;
    }

    public function all(): array
    {
        return $this->filters;
    }

    public function isEmpty(): bool
    {
        return empty($this->all());
    }
}