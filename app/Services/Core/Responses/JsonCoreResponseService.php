<?php

namespace App\Services\Core\Responses;

use Illuminate\Http\JsonResponse;

abstract class JsonCoreResponseService
{
    /**
     * Получить данные методы в json формате
     *
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public static function json(bool $success, string $message, mixed $data = [], int $code = 200): JsonResponse
    {
        return self::getResponse($success, $message, $data, $code);
    }

    /**
     * Get success json response
     *
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public static function success(string $message, mixed $data = [], int $code = 200): JsonResponse
    {
        return self::getResponse(true, $message, $data, $code);
    }

    /**
     * Get json response
     *
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    private static function getResponse(bool $success, string $message, mixed $data = [], int $code = 200): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
