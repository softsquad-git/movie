<?php

namespace App\Interfaces\Albums\Photos;

use App\Models\Albums\Photo;

interface PhotoServiceInterface
{
    /**
     * @param array $data
     * @param Photo|null $photo
     * @return bool|null
     */
    public function save(array $data, Photo $photo = null): ?bool;

    /**
     * @param Photo $photo
     * @return bool|null
     */
    public function remove(Photo $photo): ?bool;
}
