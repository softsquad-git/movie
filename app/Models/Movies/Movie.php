<?php

namespace App\Models\Movies;

use App\Models\Categories\Category;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'movies';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
        'src',
        'status',
        'is_comment',
        'is_rating'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
