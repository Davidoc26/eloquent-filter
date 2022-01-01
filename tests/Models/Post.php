<?php

declare(strict_types=1);

namespace Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\Database\Factories\PostFactory;

final class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}