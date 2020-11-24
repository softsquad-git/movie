<?php

namespace App\Services\Categories;

use App\Interfaces\Categories\CategoryServiceInterface;
use App\Models\Categories\Category;
use \Exception;
use App\Interfaces\Translations\TranslateServiceInterface as TranslateService;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @var TranslateService $translateService
     */
    private $translateService;

    /**
     * @param TranslateService $translateService
     */
    public function __construct(TranslateService $translateService)
    {
        $this->translateService = $translateService;
    }

    public function save(array $data, Category $category = null): ?Category
    {
        if ($category) {
            $category->update($data);

            return $category;
        }

        $category = Category::create($data);
        $this->translateService->create($data['translate'], $category);

        return $category;
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
