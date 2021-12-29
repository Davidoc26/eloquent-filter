<?php

declare(strict_types=1);

namespace Tests;

use Tests\Filters\ArgumentsLimitTestFilter;
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
}
