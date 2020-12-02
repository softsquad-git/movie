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
        return Auth::user()->albums()->get();
    }
}
