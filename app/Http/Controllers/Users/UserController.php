<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use App\Interfaces\Users\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\Auth;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserResource|JsonResponse
     */
    public function logged()
    {
        try {
            $item = $this->userRepository->find(Auth::id());

            return new UserResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }
}
