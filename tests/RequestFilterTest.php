<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Database\Eloquent\Collection;
use Tests\Models\User;
use function request;

class RequestFilterTest extends TestCase
{
    public function testRequestFilterSetsLimitOnBuilder(): void
    {
        request()->merge(['limit' => 2]);
        /**
         * @var Collection $users
         */
        $users = User::filter()->get();
        self::assertEquals(2, $users->count());
    }
}
