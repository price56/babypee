<?php

namespace App\Services\Auth;

use App\DTO\Auth\UserLoginDTO;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    /**
     * @throws ApiException
     */
    public function loginUser(array $authId, string $password): User
    {
        $user = User::where($authId)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw new ApiException('Unauthenticated', 401);
        }

        return $user;
    }

    public function logout(User $user): void
    {
        $user->tokens()->each(function (PersonalAccessToken $token) use ($user) {
            if ($user->currentAccessToken() === $token) {
                $token->delete();
            }
        });
    }

    public function createToken(User $user, string|null $deviceType): string
    {
        return $user->createToken($deviceType ?? 'unknown')->plainTextToken;
    }

    public function setupAppType(User $user, string|null $appType = null): void
    {
        $user->update([
            'app_type' => $appType
        ]);
    }

    public function join(array $joinUserData): User
    {
        return User::create($joinUserData);
    }

    /**
     * @throws ApiException
     */
    public function checkUserPassword(string $password): void
    {
        $user = Auth::user();

        if (!Hash::check($password, $user->password)) {
            throw new ApiException('비밀번호가 일치하지 않아요!', 403);
        }
    }

    public function withdrawUserAccount(User $user): void
    {
        $user->update([
            'email' => "{$user->id}|{$user->email}",
            'mobile_invalid_at' => now(),
            'deleted_at' => now(),
        ]);
    }
}
