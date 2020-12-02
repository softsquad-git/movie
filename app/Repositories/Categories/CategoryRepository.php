<?php

namespace App\Repositories\Categories;

use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Categories\Category;
use \Illuminate\Database\Eloquent\Collection;
use \Exception;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @return Category[]|Collection|mixed
     */
    public function findAll()
    {
        return Category::all();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function find(int $id)
    {
        $item = Category::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }

    /**
     * @param array $filters
     * @return Category|null
     */
    public function findOneBy(array $filters): ?Category
    {
        return Category::where($filters)
            ->first();
    }

    /**
     * @param array $filters
     * @param string|null $ordering
     * @param int|null $pagination
     * @return mixed
     */
    public function findBy(array $filters, ?string $ordering = 'DESC', ?int $pagination = 20)
    {
        return Category::orderBy('id', $ordering ?? 'DESC')
            ->where($filters)
            ->paginate($pagination ?? 20);
    }
}
