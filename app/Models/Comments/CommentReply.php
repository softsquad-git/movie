<?php

namespace App\Models\Comments;

use App\Models\Likes\Like;
use App\Models\Users\User;
use App\Services\Comments\Answers\CommentReplyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CommentReply extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'comment_answers';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'comment_id',
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
     * @return BelongsTo
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'resource_id', 'id')
            ->where('resource_type', CommentReplyService::RESOURCE_TYPE);
    }
}
