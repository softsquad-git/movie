<?php

namespace App\Models\Likes;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'likes';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'resource_id',
        'resource_type',
        'like'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
