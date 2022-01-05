<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CreateFilterCommand extends GeneratorCommand
{
    protected $signature = 'make:filter {name}';
    protected $description = 'Create a new filter';
    protected $type = 'Filter';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/Filter.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Filters';
    }
}
