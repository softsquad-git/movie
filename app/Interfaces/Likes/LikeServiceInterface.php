<?php

namespace App\Interfaces\Likes;

interface LikeServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function like(array $data);
}
