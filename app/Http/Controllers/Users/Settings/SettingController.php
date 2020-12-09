<?php

namespace App\Http\Controllers\Users\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AvatarRequest;
use App\Http\Requests\Settings\BasicDataRequest;
use App\Http\Requests\Settings\ChangePasswordRequest;
use App\Interfaces\Settings\SettingServiceInterface as SettingService;
use App\Interfaces\Settings\SettingRepositoryInterface as SettingRepository;
use \Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class SettingController extends Controller
{
    /**
     * @var SettingRepository $settingRepository
     */
    private $settingRepository;

    /**
     * @var SettingService $settingService
     */
    private $settingService;

    /**
     * @param SettingService $settingService
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingService $settingService, SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->settingService = $settingService;
    }

    /**
     * @param BasicDataRequest $request
     * @return JsonResponse
     */
    public function changeBasicData(BasicDataRequest $request): JsonResponse
    {
        try {
            $this->settingService->changeBasicData($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.update'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.update'));
        }
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            $this->settingService->changePassword($request->all());

            return $this->jsonSuccessResponse(trans('messages.success.update'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.update'));
        }
    }

    /**
     * @param AvatarRequest $request
     * @return JsonResponse
     */
    public function changeAvatar(AvatarRequest $request): JsonResponse
    {
        try {
            $this->settingService->changeAvatar($request->file('image'));

            return $this->jsonSuccessResponse(trans('messages.success.update'));
        } catch (Exception $e) {
            return $this->jsonErrorResponse($e, trans('messages.error.update'));
        }
    }
}
