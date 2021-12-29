<?php

declare(strict_types=1);

namespace Tests\Models;

use Davidoc26\EloquentFilter\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Database\Factories\UserFactory;
use Tests\Filters\LimitTestRequestFilter;
use Tests\RequestFilterTest;

final class User extends Model
{
    use HasFactory, Filterable;

    protected $table = 'users';

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function getFilters(): array
    {
        return [
            LimitTestRequestFilter::class,
        ];
    }

}
