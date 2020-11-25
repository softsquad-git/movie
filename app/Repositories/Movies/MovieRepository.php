<?php

namespace App\Repositories\Movies;

use App\Interfaces\Movies\MovieRepositoryInterface;
use App\Models\Movies\Movie;
use \Illuminate\Database\Eloquent\Collection;
use \Exception;

class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @return Movie[]|Collection|mixed
     */
    public function findAll()
    {
        return Movie::all();
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return mixed
     */
    public function findBy(array $filters, $ordering = 'DESC', $pagination = 20)
    {
        $data = Movie::orderBy('id', $filters['ordering'] ?? $ordering)
            ->where($filters);
        if (isset($filters['title'])) {
            $data->andWhere('title', 'like', '%' . $filters['title'] . '%');
        }
        return $data->paginate($filters['pagination'] ?? $pagination);
    }

    /**
     * @param array $filters
     * @return Movie|null
     */
    public function findOnBy(array $filters): ?Movie
    {
        return Movie::where($filters)
            ->first();
    }

    /**
     * @param int $id
     * @return Movie|null
     * @throws Exception
     */
    public function find(int $id): ?Movie
    {
        $item = Movie::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }
}
