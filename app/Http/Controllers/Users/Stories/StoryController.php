<?php

namespace App\Http\Controllers\Users\Stories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stories\StoryRequest;
use App\Http\Resources\Stories\StoriesResource;
use App\Http\Resources\Stories\StoryResource;
use Illuminate\Support\Facades\Auth;
use \Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use App\Interfaces\Stories\StoryRepositoryInterface as StoryRepository;
use App\Interfaces\Stories\StoryServiceInterface as StoryService;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoryController extends Controller
{
    /**
     * @var StoryRepository $storyRepository
     */
    private $storyRepository;

    /**
     * @var StoryService $storyService
     */
    private $storyService;

    /**
     * @param StoryService $storyService
     * @param StoryRepository $storyRepository
     */
    public function __construct(StoryService $storyService, StoryRepository $storyRepository)
    {
        $this->storyService = $storyService;
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
            $filters['user'] = Auth::id();
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

    /**
     * @param StoryRequest $request
     * @return JsonResponse
     */
    public function create(StoryRequest $request): JsonResponse
    {
        try {
            $this->storyService->save($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }

    /**
     * @param StoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoryRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->storyRepository->find($id);
            $this->storyService->save($request->all(), $item);

            return $this->jsonSuccessResponse(trans('messages.success.updated'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.updated'));
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request): JsonResponse
    {
        try {
            $ids = $request->query->get('ids');
            foreach (json_decode($ids) as $id) {
                $item = $this->storyRepository->find($id);
                $this->storyService->remove($item);
            }

            return $this->jsonSuccessResponse(trans('messages.success.removed'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.removed'));
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function archive(Request $request): JsonResponse
    {
        try {
            $ids = $request->query->get('ids');
            foreach (json_decode($ids) as $id) {
                $item = $this->storyRepository->find($id);
                $this->storyService->archive($item);
            }

            return $this->jsonSuccessResponse(trans('messages.success.archive'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.archive'));
        }
    }
}
