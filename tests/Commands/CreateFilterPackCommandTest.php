<?php

declare(strict_types=1);

namespace Tests\Commands;

use Tests\TestCase;
use function app_path;

class CreateFilterPackCommandTest extends TestCase
{
    public function testCreate(): void
    {
        $this->artisan('make:filter-pack', ['name' => 'TestFilterPack'])->assertSuccessful();

        $this->assertFileExists(app_path('Filters/Packs/TestFilterPack.php'));
    }
}
