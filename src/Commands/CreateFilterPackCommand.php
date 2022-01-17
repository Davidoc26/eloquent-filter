<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CreateFilterPackCommand extends GeneratorCommand
{
    protected $signature = 'make:filter-pack {name}';
    protected $description = 'Create a new filter pack';
    protected $type = 'Filter pack';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/FilterPack.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Filters\Packs';
    }
}
