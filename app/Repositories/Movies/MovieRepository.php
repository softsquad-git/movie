<?php

namespace App\Repositories\Movies;

use App\Helpers\Status;
use App\Interfaces\Movies\MovieRepositoryInterface;
use App\Models\Movies\Movie;
use \Illuminate\Database\Eloquent\Collection;
use \Exception;
use Illuminate\Support\Facades\Auth;

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
        $data = Movie::orderBy('id', $filters['ordering'] ?? $ordering);
        if (isset($filters['title']) && !empty($title = $filters['title'])) {
            $data->where('title', 'like', '%' . $title . '%');
        }
        if (isset($filters['category']) && !empty($category = $filters['category'])) {
            $data->where('category_id', $category);
        }
        if (isset($filters['status']) && !empty($status = $filters['status'])) {
            $data->where('status', $status);
        }
        if (isset($filters['user']) && !empty($user = $filters['user'])) {
            $data->where('user_id', $user);
        }
        if (isset($filters['except']) && !empty($except = $filters['except'])) {
            $data->whereIn('id', '!=', json_decode($except));
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
