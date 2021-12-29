<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Traits;

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

}
