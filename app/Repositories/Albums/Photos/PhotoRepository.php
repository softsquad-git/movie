<?php

namespace App\Repositories\Albums\Photos;

use App\Interfaces\Albums\Photos\PhotoRepositoryInterface;
use App\Models\Albums\Photo;
use \Exception;
use \Illuminate\Database\Eloquent\Collection;

class PhotoRepository implements PhotoRepositoryInterface
{
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20)
    {
        return Photo::where($filters)
            ->orderBy('id', $ordering)
            ->paginate($pagination);
    }

    /**
     * @return Photo[]|Collection|mixed
     */
    public function findAll()
    {
        return Photo::all();
    }

    /**
     * @param int $id
     * @return Photo|null
     * @throws Exception
     */
    public function find(int $id): ?Photo
    {
        $item = Photo::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }

    /**
     * @param array $filters
     * @return Photo|null
     */
    public function findByOne(array $filters): ?Photo
    {
        return Photo::where($filters)->first();
    }
}
