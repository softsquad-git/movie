<?php

namespace App\Http\Controllers\Front\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ProfileInfoResource;
use App\Http\Resources\Users\UserResource;
use App\Interfaces\Users\UserRepositoryInterface as UserRepository;
use \Exception;
use \Symfony\Component\HttpFoundation\JsonResponse;

class ProfileController extends Controller
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
     * @param int $id
     * @return UserResource|JsonResponse
     */
    public function findUser(int $id)
    {
        try {
            $item = $this->userRepository->find($id);

            return new UserResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }

    /**
     * @param int $id
     * @return ProfileInfoResource|JsonResponse
     */
    public function findInfoUser(int $id)
    {
        try {
            $item = $this->userRepository->find($id);

            return new ProfileInfoResource($item);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.find'));
        }
    }
}
