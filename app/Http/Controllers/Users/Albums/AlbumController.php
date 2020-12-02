<?php

namespace App\Http\Controllers\Users\Albums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Albums\AlbumRequest;
use App\Http\Resources\Albums\AlbumResource;
use App\Http\Resources\Albums\AlbumsResource;
use Illuminate\Http\Request;
use App\Interfaces\Albums\AlbumRepositoryInterface as AlbumRepository;
use App\Interfaces\Albums\AlbumServiceInterface as AlbumService;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AlbumController extends Controller
{
    /**
     * @var AlbumRepository $albumRepository
     */
    private $albumRepository;

    /**
     * @var AlbumService $albumService
     */
    private $albumService;

    /**
     * @param AlbumRepository $albumRepository
     * @param AlbumService $albumService
     */
    public function __construct(AlbumRepository $albumRepository, AlbumService $albumService)
    {
        $this->albumRepository = $albumRepository;
        $this->albumService = $albumService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->all();
        try {
            $data = $this->albumRepository->findBy($filters);

            return AlbumsResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @return JsonResponse
     */
    public function findAll(): JsonResponse
    {
        try {
            $data = $this->albumRepository->findAll();
            return $this->jsonSuccessResponse(trans('messages.success.get'), [
                'data' => $data
            ]);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @param int $id
     * @return AlbumResource|JsonResponse
     */
    public function find(int $id)
    {
        try {
            $item = $this->albumRepository->find($id);

            return new AlbumResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }

    public function create(AlbumRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            $this->albumService->save($data);

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }

    /**
     * @param AlbumRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AlbumRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->all();
            $item = $this->albumRepository->find($id);
            $this->albumService->save($data, $item);

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
            $this->albumService->remove($this->albumRepository->find($request->get('id')));

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
            $this->albumService->archive($this->albumRepository->find($request->get('id')));

            return $this->jsonSuccessResponse(trans('messages.success.archive'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.archive'));
        }
    }
}
