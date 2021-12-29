<?php

declare(strict_types=1);

namespace Tests\Commands;

use Tests\TestCase;
use function app_path;

class CreateFilterCommandTest extends TestCase
{
    public function testCreate(): void
    {
        $this->artisan('make:filter', ['name' => 'TestFilter'])->assertSuccessful();

        $this->assertFileExists(app_path('Filters/TestFilter.php'));
    }
}
