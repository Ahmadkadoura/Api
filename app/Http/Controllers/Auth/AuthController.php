<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Http\Resources\loginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(protected AuthRepository $authRepository)
    {
        $this->middleware(['auth:sanctum'])->only('logout');
    }

    public function login(LoginRequest $request)
    {
        $userData = $request->validated();
        $user = $this->authRepository->login($userData);
        return new loginResource($user);
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }

    public function register(registerRequest $request)
    {
        $userData = $request->validated();
        $user = $this->authRepository->register($userData);
        return new RegisterResource($user);
    }
}
