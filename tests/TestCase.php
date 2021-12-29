<?php

declare(strict_types=1);

namespace Tests;

use Davidoc26\EloquentFilter\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Models\Post;
use Tests\Models\User;
use function app_path;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected const USER_COUNT = 20;

    protected function setUp(): void
    {
        parent::setUp();

        $this->freshFiles();

        User::factory()
            ->has(Post::factory()
                ->count(2)
                ->state(function (array $attributes, User $user) {
                    return ['user_id' => $user->id];
                }),
                'posts')
            ->count(self::USER_COUNT)
            ->create();
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    private function freshFiles(): void
    {
        File::deleteDirectory(app_path('Filters/'));
    }
}
