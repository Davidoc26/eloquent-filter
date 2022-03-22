<?php

namespace Tests;

use Davidoc26\EloquentFilter\Exceptions\ArgumentsNotSpecifiedException;
use Davidoc26\EloquentFilter\Handlers\RequestFilterHandler;
use Illuminate\Database\Eloquent\Builder;
use Tests\Filters\ArgumentsLimitTestRequestFilter;

class RequestFilterHandlerTest extends TestCase
{
    public function testArgumentsBeenSet(): void
    {
        $filter = new ArgumentsLimitTestRequestFilter();

        (new RequestFilterHandler())->handle($filter, app(Builder::class), function (Builder $builder): Builder {
            return $builder;
        }, [
            'limit' => '2',
        ]);

        self::assertEquals(2, (int)$filter->getArguments()['limit']);
    }

    public function testArgumentsNotSpecifiedWhenItMust(): void
    {
        self::expectException(ArgumentsNotSpecifiedException::class);

        $filter = new ArgumentsLimitTestRequestFilter();

        (new RequestFilterHandler())->handle($filter, app(Builder::class), function (Builder $builder): Builder {
            return $builder;
        });
    }
}