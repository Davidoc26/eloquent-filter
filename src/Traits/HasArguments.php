<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Traits;

use Davidoc26\EloquentFilter\Exceptions\FilterArgumentException;

trait HasArguments
{
    public array $arguments = [];

    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @throws FilterArgumentException
     */
    public function __get(string $name): mixed
    {
        return $this->getArguments()[$name] ?? throw new FilterArgumentException("The filter does not have a $name field");
    }

}
