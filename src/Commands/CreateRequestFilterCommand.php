<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Commands;

use Illuminate\Console\GeneratorCommand;

final class CreateRequestFilterCommand extends GeneratorCommand
{
    protected $signature = 'make:request-filter {name}';
    protected $description = 'Create a new request filter';
    protected $type = 'RequestFilter';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/RequestFilter.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Filters';
    }
}
