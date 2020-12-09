<?php

namespace App\Interfaces\Likes;

use App\Models\Likes\Like;

interface LikeRepositoryInterface
{
    /**
     * @param int $id
     * @return Like|null
     */
    public function find(int $id): ?Like;

    /**
     * @param array $filters
     * @return Like|null
     */
    public function findByOne(array $filters): ?Like;
}
