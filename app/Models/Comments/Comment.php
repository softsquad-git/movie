<?php

namespace App\Models\Comments;

use App\Models\Likes\Like;
use App\Models\Users\User;
use App\Services\Comments\CommentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'comments';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'resource_id',
        'resource_type',
        'content',
        'status'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(CommentReply::class, 'comment_id');
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'resource_id', 'id')
            ->where('resource_type', CommentService::RESOURCE_TYPE);
    }
}
