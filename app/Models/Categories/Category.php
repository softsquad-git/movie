<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'categories';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'parent_id',
        'is_active',
        'image'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id', 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function child(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function translate(): HasMany
    {
        return $this->hasMany(CategoryTranslate::class, 'category_id')
            ->whereHas('lang', function ($q) {
                $q->where('code', App::getLocale());
            });
    }
}
