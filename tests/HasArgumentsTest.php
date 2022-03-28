<?php

declare(strict_types=1);

namespace Tests;

use Davidoc26\EloquentFilter\Exceptions\FilterArgumentException;
use Tests\Filters\ArgumentsLimitTestFilter;
use Tests\Filters\DynamicArgumentsLimitTestFilter;
use Tests\Models\User;

class HasArgumentsTest extends TestCase
{
    public function testLimitWithFilterArguments(): void
    {
        $users = User::withFilters([
            ArgumentsLimitTestFilter::class => ['limit' => 7],
        ])->get();

        self::assertCount(7, $users);
    }

    public function testLimitWithFilterArgumentsAccessingViaDynamicProperty(): void
    {
        $users = User::withFilters([
            DynamicArgumentsLimitTestFilter::class => ['limit' => 8],
        ])->get();

        self::assertCount(8, $users);
    }

    public function testLimitWithFilterArgumentsWhereDynamicPropertyNotExists(): void
    {
        self::expectException(FilterArgumentException::class);

        User::withFilters([DynamicArgumentsLimitTestFilter::class => ['incorrectArgument']])->get();
    }

}
