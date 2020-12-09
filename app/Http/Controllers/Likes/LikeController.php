<?php

namespace App\Http\Controllers\Likes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Likes\LikeRequest;
use App\Interfaces\Likes\LikeServiceInterface as LikeService;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Exception;

class LikeController extends Controller
{
    /**
     * @var LikeService $likeService
     */
    private $likeService;

    /**
     * @param LikeService $likeService
     */
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    /**
     * @param LikeRequest $request
     * @return JsonResponse
     */
    public function like(LikeRequest $request): JsonResponse
    {
        try {
            $item = $this->likeService->like($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.created'), ['like' => $item]);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }
}
