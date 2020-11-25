<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $msg
     * @param array $payload
     * @return JsonResponse
     */
    protected function jsonSuccessResponse(string $msg, array $payload = []): JsonResponse
    {
        return response()->json([
            'success' => 1,
            'msg' => $msg,
            'payload' => $payload
        ]);
    }

    /**
     * @param object $e
     * @param string $msg
     * @return JsonResponse
     */
    protected function jsonErrorResponse(object $e, string $msg): JsonResponse
    {
        return response()->json([
            'success' => 0,
            'msg' => config('app.debug') ? $e->getMessage() : $msg
        ]);
    }
}
