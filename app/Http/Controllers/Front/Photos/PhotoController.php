<?php

namespace App\Http\Controllers\Front\Photos;

use App\Helpers\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\Albums\AlbumsResource;
use App\Http\Resources\Albums\Photos\PhotosResource;
use Illuminate\Http\Request;
use App\Interfaces\Albums\Photos\PhotoRepositoryInterface as PhotoRepository;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Interfaces\Albums\AlbumRepositoryInterface as AlbumRepository;

class PhotoController extends Controller
{
    /**
     * @var PhotoRepository $photoRepository
     */
    private $photoRepository;

    /**
     * @var AlbumRepository $albumRepository
     */
    private $albumRepository;

    /**
     * @param PhotoRepository $photoRepository
     * @param AlbumRepository $albumRepossitory
     */
    public function __construct(PhotoRepository $photoRepository, AlbumRepository $albumRepository)
    {
        $this->photoRepository = $photoRepository;
        $this->albumRepository = $albumRepository;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $filters['is_visibility'] = Status::ON;
            $filters['is_private'] = Status::OFF;
            $filters['status'] = Status::ON;
            $filters['no_empty'] = true;
            $data = $this->albumRepository->findBy($filters);

            return AlbumsResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @param int $albumId
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function getPhotos(int $albumId)
    {
        try {
            $data = $this->photoRepository->findBy(['album_id' => $albumId]);

            return PhotosResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }
}
