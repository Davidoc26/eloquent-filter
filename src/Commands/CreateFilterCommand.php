<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Commands;

use Illuminate\Console\GeneratorCommand;

final class CreateFilterCommand extends GeneratorCommand
{
    protected $signature = 'make:filter {name}';
    protected $description = 'Create a new filter';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/Filter.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Filters';
    }
}
