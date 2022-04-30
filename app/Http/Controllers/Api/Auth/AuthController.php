<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Services\Auth\AuthInterface;
use App\Services\Core\Responses\JsonCoreResponseService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private AuthInterface $authService;

    public function __construct(AuthInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Account login",
     *     tags={"Authorization"},
     *
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     )
     * )
     *
     * Account login
     *
     * @param AuthLoginRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function login(AuthLoginRequest $request): JsonResponse
    {
        return JsonCoreResponseService::success(
            trans('message.response.get-success'),
            [
                'token' => $this->authService
                    ->login($request->validated())
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Account registration",
     *     tags={"Authorization"},
     *
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/AuthRegisterRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     )
     * )
     *
     * Account registration
     *
     * @param AuthRegisterRequest $request
     * @return JsonResponse
     */
    public function register(AuthRegisterRequest $request): JsonResponse
    {
        $this->authService->register($request->validated());

        return JsonCoreResponseService::success(trans('message.response.add-success'));
    }
}
