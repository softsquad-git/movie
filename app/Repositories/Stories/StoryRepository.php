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
        return Auth::user()->stories()->get();
    }

    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20)
    {
        $data = Auth::user()->stories()->orderBy('id', $filters['ordering'] ?? $ordering)
            ->where($filters);
        if (isset($filters['title'])) {
            $data->andWhere('title', 'like', '%' . $filters['title'] . '%');
        }

        return $data->paginate($filters['pagination'] ?? $pagination);
    }

    /**
     * @param array $filters
     * @return Story|null
     */
    public function findOneBy(array $filters): ?Story
    {
        return Auth::user()->stories()->where($filters)
            ->first();
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
