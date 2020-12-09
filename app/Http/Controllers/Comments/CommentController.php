<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentRequest;
use App\Http\Resources\Comments\CommentResource;
use App\Http\Resources\Comments\CommentsResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use App\Interfaces\Comments\CommentRepositoryInterface as CommentRepository;
use App\Interfaces\Comments\CommentServiceInterface as CommentService;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    /**
     * @var CommentRepository $commentRepository
     */
    private $commentRepository;

    /**
     * @var CommentService $commentService
     */
    private $commentService;

    /**
     * @param CommentRepository $commentRepository
     * @param CommentService $commentService
     */
    public function __construct(CommentRepository $commentRepository, CommentService $commentService)
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $data = $this->commentRepository->findBy($filters);

            return CommentsResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @param int $id
     * @return CommentResource|JsonResponse
     */
    public function find(int $id)
    {
        try {
            $item = $this->commentRepository->find($id);

            return new CommentResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }

    /**
     * @param CommentRequest $request
     * @return JsonResponse
     */
    public function create(CommentRequest $request): JsonResponse
    {
        try {
            $this->commentService->save($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }

    /**
     * @param CommentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CommentRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->commentRepository->find($id);
            $this->commentService->save($request->all(), $item);

            return $this->jsonSuccessResponse(trans('messages.success.updated'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.updated'));
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        try {
            $item = $this->commentRepository->find($id);
            $this->commentService->remove($item);

            return $this->jsonSuccessResponse(trans('messages.success.removed'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.removed'));
        }
    }
}
