<?php

namespace App\Http\Controllers\Front\Movies;

use App\Helpers\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\Movies\MovieResource;
use App\Http\Resources\Movies\MoviesResource;
use Illuminate\Http\Request;
use App\Interfaces\Movies\MovieRepositoryInterface as MovieRepository;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieController extends Controller
{
    /**
     * @var MovieRepository $movieRepository
     */
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
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
}
