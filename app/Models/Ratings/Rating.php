<?php

namespace App\Models\Ratings;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'ratings';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'resource_id',
        'resource_type',
        'rating'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
