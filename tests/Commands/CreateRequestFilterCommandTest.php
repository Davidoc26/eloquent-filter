<?php

declare(strict_types=1);

namespace Tests\Commands;

use Tests\TestCase;
use function app_path;

class CreateRequestFilterCommandTest extends TestCase
{
    public function testCreate(): void
    {
        $this->artisan('make:request-filter', ['name' => 'TestRequestFilter'])->assertSuccessful();

        $this->assertFileExists(app_path('Filters/TestRequestFilter.php'));
    }
}
