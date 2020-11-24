<?php

namespace App\Observers\Categories;

use App\Models\Categories\Category;

class CategoryObserver
{
    public function deleted(Category $category)
    {
        $category->translate()->delete();
    }
}
