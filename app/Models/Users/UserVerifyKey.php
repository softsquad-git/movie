<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVerifyKey extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_verification_keys';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'email',
        'verify_key',
        'ip_address'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
