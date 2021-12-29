<?php

declare(strict_types=1);

namespace Tests;

use Davidoc26\EloquentFilter\Exceptions\FilterInitializationException;
use Tests\Models\User;

class PipelineTest extends TestCase
{
    public function testThrowExceptionWhenUnresolvableFilter(): void
    {
        $this->expectException(FilterInitializationException::class);

        User::withFilters(["123"])->get();
    }
}
