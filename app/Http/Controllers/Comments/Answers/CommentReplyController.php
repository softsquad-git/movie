<?php

namespace App\Http\Controllers\Comments\Answers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentReplyRequest;
use App\Http\Resources\Comments\Answers\CommentAnswersResource;
use App\Http\Resources\Comments\Answers\CommentReplyResource;
use Illuminate\Http\Request;
use App\Interfaces\Comments\Answers\CommentReplyServiceInterface as CommentReplyService;
use App\Interfaces\Comments\Answers\CommentReplyRepositoryInterface as CommentReplyRepository;
use \Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentReplyController extends Controller
{
    /**
     * @var CommentReplyRepository $commentReplyRepository
     */
    private $commentReplyRepository;

    /**
     * @var CommentReplyService $commentReplyService
     */
    private $commentReplyService;

    /**
     * @param CommentReplyRepository $commentReplyRepository
     * @param CommentReplyService $commentReplyService
     */
    public function __construct(CommentReplyRepository $commentReplyRepository, CommentReplyService $commentReplyService)
    {
        $this->commentReplyRepository = $commentReplyRepository;
        $this->commentReplyService = $commentReplyService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $data = $this->commentReplyRepository->findBy($filters);

            return CommentAnswersResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @param int $id
     * @return CommentReplyResource|JsonResponse
     */
    public function find(int $id)
    {
        try {
            $item = $this->commentReplyRepository->find($id);

            return new CommentReplyResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }

    /**
     * @param CommentReplyRequest $request
     * @return JsonResponse
     */
    public function create(CommentReplyRequest $request): JsonResponse
    {
        try {
            $this->commentReplyService->save($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }

    /**
     * @param CommentReplyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CommentReplyRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->commentReplyRepository->find($id);
            $this->commentReplyService->save($request->all(), $item);

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
            $item = $this->commentReplyRepository->find($id);
            $this->commentReplyService->remove($item);

            return $this->jsonSuccessResponse(trans('messages.success.removed'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.removed'));
        }
    }
}
