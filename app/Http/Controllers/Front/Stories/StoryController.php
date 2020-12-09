<?php

namespace App\Http\Controllers\Front\Stories;

use App\Helpers\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\Stories\StoriesResource;
use App\Http\Resources\Stories\StoryResource;
use Illuminate\Http\Request;
use App\Interfaces\Stories\StoryRepositoryInterface as StoryRepository;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoryController extends Controller
{
    /**
     * @var StoryRepository $storyRepository
     */
    private $storyRepository;

    /**
     * @param StoryRepository $storyRepository
     */
    public function __construct(StoryRepository $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $filters['status'] = Status::ON;
            $data = $this->storyRepository->findBy($filters);

            return StoriesResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @param int $id
     * @return StoryResource|JsonResponse
     */
    public function find(int $id)
    {
        try {
            $item = $this->storyRepository->find($id);

            return new StoryResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }
}
