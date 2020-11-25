<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\Auth\AuthServiceInterface as AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Exception;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->login($request->all());
            return $this->jsonSuccessResponse(trans('messages.success.logged'), $data);
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.logged'));
        }
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->authService->register($request->all());
            return $this->jsonSuccessResponse(trans('messages.success.registered'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.registered'));
        }
    }

    public function activate(string $key)
    {
        try {
            $this->authService->activateAccount($key);
            return response()->json(true);
            /**TODO
             * | Dodać odpowiednie przekierowanie 1/0
             */
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
