<?php

declare(strict_types=1);

namespace Tests;

use Tests\FilterPacks\TestFilterPack;
use Tests\Models\User;

class FilterPackTest extends TestCase
{
    public function testPackWasApplied(): void
    {
        $users = User::withFilterPacks([TestFilterPack::class])->get();

        self::assertEquals(self::USER_COUNT, $users->first()->id);
        self::assertCount(5, $users);
    }
}
