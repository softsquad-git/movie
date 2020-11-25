<?php

namespace App\Models\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * @var string $table
     */
    protected $table = 'users';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'username',
        'password',
        'is_verified',
        'role_id',
        'birthday',
        'sex',
        'is_term'
    ];

    /**
     * @var string[] $hidden
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->name . ' ' . $this->last_name;
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class);
    }

    /**
     * @return HasOne
     */
    public function avatar(): HasOne
    {
        return $this->hasOne(UserAvatar::class, 'id');
    }

    /**
     * @return HasOne
     */
    public function info(): HasOne
    {
        return $this->hasOne(UserInformation::class, 'user_id');
    }
}
