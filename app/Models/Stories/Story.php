<?php

namespace App\Models\Stories;

use App\Models\Categories\Category;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
