<?php

namespace App\Repositories\Likes;

use App\Interfaces\Likes\LikeRepositoryInterface;
use App\Models\Likes\Like;
use \Exception;

class LikeRepository implements LikeRepositoryInterface
{
    /**
     * @param int $id
     * @return Like|null
     * @throws Exception
     */
    public function find(int $id): ?Like
    {
        $item = Like::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }

    /**
     * @param array $filters
     * @return Like|null
     */
    public function findByOne(array $filters): ?Like
    {
        return Like::where($filters)->first();
    }

    /**
     * @param array $filters
     * @return int|null
     */
    public static function checkLike(array $filters): ?int
    {
        $like = Like::where($filters)->first();
        if ($like) {
            return $like->like == 1 ? 1 : 0;
        }
        return null;
    }
}
