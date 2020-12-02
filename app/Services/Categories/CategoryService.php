<?php

namespace App\Services\Categories;

use App\Interfaces\Categories\CategoryServiceInterface;
use App\Models\Categories\Category;
use \Exception;
use Illuminate\Support\Facades\DB;

class CategoryService implements CategoryServiceInterface
{

    /**
     * @param array $data
     * @param Category|null $category
     * @return Category|null
     * @throws Exception
     */
    public function save(array $data, Category $category = null): ?Category
    {
        if ($category) {
            $category->update($data);

            return $category;
        }

        DB::beginTransaction();
        try {
            $category = Category::create($data);
            DB::commit();
            return $category;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Category $category
     * @return bool|null
     * @throws Exception
     */
    public function remove(Category $category): ?bool
    {
        return $category->delete();
    }
}
