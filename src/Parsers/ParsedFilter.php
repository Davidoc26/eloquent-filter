<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Parsers;

final class ParsedFilter
{
    public function __construct(
        private string $filter,
        private ?array $arguments = null
    )
    {
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->filter;
    }

    /**
     * @return array|null
     */
    public function getArguments(): ?array
    {
        return $this->arguments;
    }
}
