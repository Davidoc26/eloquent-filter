<?php

declare(strict_types=1);

namespace Tests;

use Davidoc26\EloquentFilter\Parsers\FilterParser;
use Tests\Filters\LimitTestFilter;
use Tests\Filters\OrderByTestFilter;

class FilterParserTest extends TestCase
{
    public function testGenerateParsedFilterWithoutArguments(): void
    {
        $parser = FilterParser::createFromFilters([]);
        $parsedFilter = $parser->generateParsedFilter('TestFilter', []);

        self::assertEquals([], $parsedFilter->getArguments());
    }

    public function testGenerateParsedFilterWithArguments(): void
    {
        $parser = FilterParser::createFromFilters([]);
        $parsedFilter = $parser->generateParsedFilter('TestFilter', [1, 2, 3]);

        self::assertEquals([1, 2, 3], $parsedFilter->getArguments());
    }

    public function testSameFiltersWereRemoved(): void
    {
        $collection = FilterParser::createFromFilters(
            [
                LimitTestFilter::class,
                LimitTestFilter::class,
                OrderByTestFilter::class,
                OrderByTestFilter::class,
            ]
        )->parse();

        self::assertCount(2, $collection->all());
    }
}
