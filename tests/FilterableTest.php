<?php

declare(strict_types=1);

namespace Tests;

use Davidoc26\EloquentFilter\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Tests\Filters\LimitTestRequestFilter;
use Tests\Filters\OrderByTestFilter;
use Tests\Models\User;
use function class_uses;
use function request;

class FilterableTest extends TestCase
{
    public function testFilterableTraitUsed(): void
    {
        $traits = class_uses(User::class);

        self::assertContains(Filterable::class, $traits);
    }

    public function testModelReturnsFilters(): void
    {
        $user = new User();

        self::assertContains(LimitTestRequestFilter::class, $user->getFilters());
    }

    public function testScopeFilterReturnsBuilderInstance(): void
    {
        $builder = User::filter();

        self::assertInstanceOf(Builder::class, $builder);
    }

    public function testScopeWithFiltersReturnsBuilderInstance(): void
    {
        $builder = User::withFilters([]);

        self::assertInstanceOf(Builder::class, $builder);
    }

    public function testAdditionalFilterProvidedWithLimitRequest()
    {
        request()->merge(['limit' => 5]);

        $users = User::filter([
            OrderByTestFilter::class
        ])->get();

        self::assertEquals(self::USER_COUNT, $users->first()->id);
        self::assertEquals(5, $users->count());
    }
}
