<?php

namespace App\Repositories\Stories;

use App\Interfaces\Stories\StoryRepositoryInterface;
use App\Models\Stories\Story;
use \Illuminate\Database\Eloquent\Collection;
use \Exception;
use Illuminate\Support\Facades\Auth;

class StoryRepository implements StoryRepositoryInterface
{
    /**
     * @return Story[]|Collection|mixed
     */
    public function findAll()
    {
        return Story::all();
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return mixed
     */
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20)
    {
        $data = Story::orderBy('id', $filters['ordering'] ?? $ordering);
        if (isset($filters['title']) && !empty($title = $filters['title'])) {
            $data->where('title', 'like', '%' . $title . '%');
        }
        if (isset($filters['status']) && !empty($status = $filters['status'])) {
            $data->where('status', $status);
        }
        if (isset($filters['user']) && !empty($user = $filters['user'])) {
            $data->where('user_id', $user);
        }

        return $data->paginate($filters['pagination'] ?? $pagination);
    }

    /**
     * @param array $filters
     * @return Story|null
     */
    public function findOneBy(array $filters): ?Story
    {
        return Story::where($filters)->first();
    }

    /**
     * @param int $id
     * @return Story|null
     * @throws Exception
     */
    public function find(int $id): ?Story
    {
        $item = Story::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }
}
