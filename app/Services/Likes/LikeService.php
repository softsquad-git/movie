<?php

namespace App\Services\Likes;

use App\Interfaces\Likes\LikeServiceInterface;
use App\Models\Likes\Like;
use App\Interfaces\Likes\LikeRepositoryInterface as LikeRepository;
use Illuminate\Support\Facades\Auth;

class LikeService implements LikeServiceInterface
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'LIKE';

    /**
     * @var LikeRepository $likeRepository
     */
    private $likeRepository;

    /**
     * @param LikeRepository $likeRepository
     */
    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    /**
     * @param array $data
     * @return int|null
     * @throws \Exception
     */
    public function like(array $data): ?int
    {
        $data['user_id'] = Auth::id();
        $like = $this->likeRepository->findByOne([
            'resource_id' => $data['resource_id'],
            'resource_type' => $data['resource_type']
        ]);
        if (!$like) {
            $like = Like::create($data);

            return $like->like;
        }

        if ($like->like != $data['like']) {
            $like->update([
                'like' => $like->like == 1 ? 0 : 1
            ]);

            return $like->like;
        }

        $like->delete();

        return null;
    }
}
