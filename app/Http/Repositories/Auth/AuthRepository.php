<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;

class AuthRepository
{
    // use ApiResponse;

    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login($data)
    {
        $user = User::where('phone', $data['phone'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'Data' => [__('The provided credentials are incorrect')],
            ]);
        }
        $accessToken = $user->createToken($user->name);

        return $this->respondWithToken($accessToken, $user);
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->user()->tokens()->delete();

            return response(__('Successfully logged out'));
        } else {
            return response(__('User is not authenticated'), 401);
        }
    }

    public function register($data): array
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $accessToken = $user->createToken($user->name);
        return $this->respondWithToken($accessToken, $user);
    }

    public function profile(): User
    {
        return auth()->user();
    }

    protected function respondWithToken(NewAccessToken $token, $user = null): array
    {
        return [
            'token_type' => 'bearer',
            'access_token' => $token->plainTextToken,
            'access_expires_at' => $token->accessToken->expires_at,
            'user' => $user,
        ];
    }
}
