<?php

namespace App\Exceptions;

use App\Services\Core\Responses\JsonCoreResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiException extends Exception
{
    /**
     * Error constructor
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return JsonCoreResponseService::json(false, $this->getMessage(), $request->all(), $this->getCode());
    }
}
