<?php

namespace App\Interfaces\Albums;

use App\Models\Albums\Album;

interface AlbumServiceInterface
{
    /**
     * @param array $data
     * @param Album|null $album
     * @return Album|null
     */
    public function save(array $data, Album $album = null): ?Album;

    /**
     * @param Album $album
     * @return bool|null
     */
    public function remove(Album $album): ?bool;

    /**
     * @param Album $album
     * @return bool|null
     */
    public function archive(Album $album): ?bool;
}
