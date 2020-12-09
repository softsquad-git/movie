<?php

namespace App\Repositories\Albums;

use App\Interfaces\Albums\AlbumRepositoryInterface;
use App\Models\Albums\Album;
use \Exception;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AlbumRepository implements AlbumRepositoryInterface
{
    /**
     * @return Album[]|Collection|mixed
     */
    public function findAll()
    {
        return Auth::user()->albums()->get();
    }

    /**
     * @param int $id
     * @return Album|null
     * @throws Exception
     */
    public function find(int $id): ?Album
    {
        $item = Album::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }

    /**
     * @param array $filters
     * @return Album|null
     */
    public function findByOne(array $filters): ?Album
    {
        return Album::where($filters)->first();
    }

    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20)
    {
        $data = Album::orderBy('id', $filters['ordering'] ?? $ordering);
        if (isset($filters['name']) && !empty($name = $filters['name'])) {
            $data->where('name', 'like', '%' . $name . '%');
        }
        if (isset($filters['status']) && !empty($status = $filters['status'])) {
            $data->where('status', $status);
        }
        if (isset($filters['user']) && !empty($user = $filters['user'])) {
            $data->where('user_id', $user);
        }
        if (isset($filters['is_private']) && !empty($isPrivate = $filters['is_private'])) {
            $data->where('is_private', $isPrivate);
        }
        if (isset($filters['is_visibility']) && !empty($isPrivate = $filters['is_visibility'])) {
            $data->where('is_visibility', $isPrivate);
        }
        if (isset($filters['no_empty']) && !empty($noEmpty = $filters['no_empty']) && $noEmpty == true) {
            $data->whereHas('photos', function ($q) {});
        }

        return $data->paginate($filters['pagination'] ?? $pagination);
    }
}
