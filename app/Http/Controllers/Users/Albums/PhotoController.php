<?php

namespace App\Http\Controllers\Users\Albums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Albums\PhotoRequest;
use App\Http\Resources\Albums\Photos\PhotosResource;
use Illuminate\Http\Request;
use App\Interfaces\Albums\Photos\PhotoServiceInterface as PhotoService;
use App\Interfaces\Albums\Photos\PhotoRepositoryInterface as PhotoRepository;
use \Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PhotoController extends Controller
{
    /**
     * @var PhotoService $photoService
     */
    private $photoService;

    /**
     * @var PhotoRepository $photoRepository
     */
    private $photoRepository;

    /**
     * @param PhotoService $photoService
     * @param PhotoRepository $photoRepository
     */
    public function __construct(PhotoService $photoService, PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
        $this->photoService = $photoService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        $filters = [
            'album_id' => $request->get('album_id')
        ];
        try {
            $data = $this->photoRepository->findBy($filters);

            return PhotosResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    public function find(int $id)
    {

    }

    /**
     * @param PhotoRequest $request
     * @return JsonResponse
     */
    public function create(PhotoRequest $request): JsonResponse
    {
        try {
            $data = [
                'album_id' => $request->get('album_id'),
                'photos' => $request->file('photos')
            ];
            $this->photoService->save($data);

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
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
                $item = $this->photoRepository->find($id);
                $this->photoService->remove($item);
            }

            return $this->jsonSuccessResponse(trans('messages.success.removed'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('message.error.removed'));
        }
    }
}
