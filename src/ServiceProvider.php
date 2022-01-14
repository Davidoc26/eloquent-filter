<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter;

use Davidoc26\EloquentFilter\Commands\CreateFilterCommand;
use Davidoc26\EloquentFilter\Commands\CreateFilterPackCommand;
use Davidoc26\EloquentFilter\Commands\CreateRequestFilterCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            CreateFilterCommand::class,
            CreateRequestFilterCommand::class,
            CreateFilterPackCommand::class,
        ]);
    }
}