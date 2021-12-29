<?php

declare(strict_types=1);

namespace Tests;

use Tests\Filters\LimitTestFilter;
use Tests\Models\User;

class FilterTest extends TestCase
{
    public function testFilterSetsLimitOnBuilder()
    {
        $users = User::withFilters([
            LimitTestFilter::class,
        ])->get();

        self::assertEquals(15, $users->count());
    }

}
