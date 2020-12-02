<?php

namespace App\Services\Albums;
use App\Helpers\Status;
use App\Interfaces\Albums\AlbumServiceInterface;
use App\Models\Albums\Album;
use Illuminate\Support\Facades\Auth;
use \Exception;

class AlbumService implements AlbumServiceInterface
{
    /**
     * @param array $data
     * @param Album|null $album
     * @return Album|null
     */
    public function save(array $data, Album $album = null): ?Album
    {
        $data['user_id'] = Auth::id();
        if ($album) {
            $album->update($data);

            return $album;
        }

        $album = Album::create($data);

        return $album;
    }

    /**
     * @param Album $album
     * @return bool|null
     * @throws Exception
     */
    public function remove(Album $album): ?bool
    {
        return $album->delete();
    }

    /**
     * @param Album $album
     * @return bool|null
     */
    public function archive(Album $album): ?bool
    {
        if ($album->status == Status::ON) {
            $album->update(['status' => Status::OFF]);
            return true;
        }

        if ($album->status == Status::OFF) {
            $album->update(['status' => Status::ON]);
            return true;
        }

        return false;
    }
}
