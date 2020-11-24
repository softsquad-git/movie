<?php

namespace App\Interfaces\Categories;

use App\Models\Categories\Category;

interface CategoryServiceInterface
{
    /**
     * @param array $data
     * @param Category|null $category
     * @return Category|null
     */
    public function save(array $data, Category $category = null): ?Category;

    /**
     * @param Category $category
     * @return bool|null
     */
    public function remove(Category $category): ?bool;
}
