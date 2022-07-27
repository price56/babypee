<?php

namespace App\Http\Controllers;

use App\Events\Auth\UserJoinEvent;
use App\Exceptions\ApiException;
use App\Http\Requests\Auth\JoinRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\WithDrawRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {

    }

    /**
     * @throws ApiException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $appType = $request->deviceType();
        $user = $this->authService->loginUser($request->authId(), $request->password());

        $this->authService->setupAppType($user, $appType);

        return $this->responseJson([
            'access_token' => $this->authService->createToken($user, $appType),
            'device_type' => $request->deviceType(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return $this->responseJson([
            'message' => 'success',
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function join(JoinRequest $request): JsonResponse
    {
        return \DB::transaction(function () use ($request) {
            $user = $this->authService->join($request->joinUserData());

            UserJoinEvent::dispatch($user->id);

            return $this->responseJson([
                'user' => $user,
                'access_token' => $this->authService->createToken($user, $user->app_type),
            ], 201);
        });
    }

    /**
     * @throws ApiException
     */
    public function withdraw(WithDrawRequest $request, AuthService $authService): JsonResponse
    {
        $user = $request->user();
        $authService->checkUserPassword($request->get('password'));

        $this->authService->withdrawUserAccount($user);

        return $this->responseJson([], 204);
    }


}
