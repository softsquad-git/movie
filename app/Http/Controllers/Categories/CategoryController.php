<?php

namespace App\Http\Controllers\Categories;

use App\Helpers\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoriesResource;
use Illuminate\Http\Request;
use App\Interfaces\Categories\CategoryRepositoryInterface as CategoryRepository;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $filters['is_active'] = 1;
            $data = $this->categoryRepository
                ->findBy($filters, $request->get('ordering'), $request->get('pagination'));

            return CategoriesResource::collection($data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.get'));
        }
    }
}
