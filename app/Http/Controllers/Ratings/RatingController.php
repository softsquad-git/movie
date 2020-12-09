<?php

namespace App\Http\Controllers\Ratings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ratings\RatingRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use App\Interfaces\Ratings\RatingRepositoryInterface as RatingRepository;
use App\Interfaces\Ratings\RatingServiceInterface as RatingService;
use \Exception;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * @var RatingRepository $ratingRepository
     */
    private $ratingRepository;

    /**
     * @var RatingService $ratingService
     */
    private $ratingService;

    /**
     * @param RatingRepository $ratingRepository
     * @param RatingService $ratingService
     */
    public function __construct(RatingRepository $ratingRepository, RatingService $ratingService)
    {
        $this->ratingRepository = $ratingRepository;
        $this->ratingService = $ratingService;
    }

    /**
     * @param RatingRequest $request
     * @return JsonResponse
     */
    public function create(RatingRequest $request): JsonResponse
    {
        try {
            $item = $this->ratingRepository->findByOne([
                'user_id' => Auth::id(),
                'resource_id' => $request->get('resource_id'),
                'resource_type' => $request->get('resource_type')
            ]);
            $this->ratingService->save($request->all(), $item);

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function find(Request $request): JsonResponse
    {
        try {
            $item = $this->ratingRepository::findAverage([
                'resource_type' => $request->get('resource_type'),
                'resource_id' => $request->get('resource_id')
            ]);

            return $this->jsonSuccessResponse(trans('messages.success.get'), [
                'average' => $item
            ]);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }
}
