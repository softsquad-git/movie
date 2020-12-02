<?php

namespace App\Models\Albums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'photos';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'description',
        'album_id',
        'src'
    ];

    /**
     * @return BelongsTo
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
