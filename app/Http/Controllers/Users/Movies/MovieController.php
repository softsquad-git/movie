<?php

namespace App\Http\Controllers\Users\Movies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movies\MovieRequest;
use App\Http\Resources\Movies\MovieResource;
use App\Http\Resources\Movies\MoviesResource;
use Illuminate\Http\Request;
use App\Interfaces\Movies\MovieRepositoryInterface as MovieRepository;
use App\Interfaces\Movies\MovieServiceInterface as MovieService;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieController extends Controller
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * @param MovieRepository $movieRepository
     * @param MovieService $movieService
     */
    public function __construct(MovieRepository $movieRepository, MovieService $movieService)
    {
        $this->movieRepository = $movieRepository;
        $this->movieService = $movieService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $data = $this->movieRepository->findBy($filters);

            return MoviesResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }

    /**
     * @param int $id
     * @return MovieResource|JsonResponse
     */
    public function find(int $id)
    {
        try {
            $item = $this->movieRepository->find($id);

            return new MovieResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }

    /**
     * @param MovieRequest $request
     * @return JsonResponse
     */
    public function create(MovieRequest $request): JsonResponse
    {
        try {
            $this->movieService->save($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.created'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.created'));
        }
    }

    /**
     * @param MovieRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MovieRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->movieRepository->find($id);
            $this->movieService->save($request->all(), $item);

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
                $item = $this->movieRepository->find($id);
                $this->movieService->remove($item);
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
                $item = $this->movieRepository->find($id);
                $this->movieService->archive($item);
            }

            return $this->jsonSuccessResponse(trans('messages.success.archive'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.archive'));
        }
    }

}
