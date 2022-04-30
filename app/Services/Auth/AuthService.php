<?php

namespace App\Services\Auth;

use App\Exceptions\ApiException;
use App\Models\User;

class AuthService implements AuthInterface
{
    /**
     * @inheritDoc
     */
    public function login(array $data): string
    {
        if (!auth()->attempt($data)) {
            throw new ApiException(trans('errors.login'), 401);
        }

        /** @var User $user */
        $user = auth()->user();

        return $user->createToken('API Token')->accessToken;
    }

    /**
     * @inheritDoc
     */
    public function register(array $data): bool
    {
        $data['password'] = bcrypt($data['password']);
        return (bool)User::create($data);
    }
}
