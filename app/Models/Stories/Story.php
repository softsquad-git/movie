<?php

namespace App\Models\Stories;

use App\Models\Categories\Category;
use App\Models\Comments\Comment;
use App\Models\Likes\Like;
use App\Models\Ratings\Rating;
use App\Models\Users\User;
use App\Services\Stories\StoryService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Story extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'stories';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'content',
        'status',
        'is_comment',
        'is_rating'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'resource_id', 'id')
            ->where('resource_type', StoryService::RESOURCE_TYPE);
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'resource_id', 'id')
            ->where('resource_type', StoryService::RESOURCE_TYPE);
    }

    /**
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'resource_id', 'id')
            ->where('resource_type', StoryService::RESOURCE_TYPE);
    }
}
