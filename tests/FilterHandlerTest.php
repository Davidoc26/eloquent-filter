<?php

namespace Tests;

use Davidoc26\EloquentFilter\Exceptions\ArgumentsNotSpecifiedException;
use Davidoc26\EloquentFilter\Handlers\FilterHandler;
use Illuminate\Database\Eloquent\Builder;
use Tests\Filters\ArgumentsLimitTestFilter;

class FilterHandlerTest extends TestCase
{
    public function testArgumentsBeenSet(): void
    {
        $filter = new ArgumentsLimitTestFilter();

        (new FilterHandler())->handle($filter, app(Builder::class), function (Builder $builder): Builder {
            return $builder;
        }, [
            'limit' => 200,
        ]);

        self::assertEquals(200, $filter->getArguments()['limit']);
    }

    public function testArgumentsNotSpecifiedWhenItMust(): void
    {
        self::expectException(ArgumentsNotSpecifiedException::class);

        $filter = new ArgumentsLimitTestFilter();

        (new FilterHandler())->handle($filter, app(Builder::class), function (Builder $builder): Builder {
            return $builder;
        });
    }
}