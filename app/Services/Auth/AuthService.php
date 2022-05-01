<?php

namespace App\Services\Auth;

use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements AuthInterface
{
    /**
     * @inheritDoc
     */
    public function login(array $data): string
    {
        if (!auth()->attempt($data)) {
            throw new ApiException(trans('errors.login'), Response::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = auth()->user();

        if (!$user->hasVerifiedEmail()) {
            throw new ApiException('Account not verified yet!', Response::HTTP_UNAUTHORIZED);
        }

        return $user->createToken('API Token')->accessToken;
    }

    /**
     * @inheritDoc
     */
    public function register(array $data): bool
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        event(new Registered($user));

        return true;
    }

    /**
     * @inheritDoc
     */
    public function verify(int $id): bool
    {
        /** @var User $user */
        $user = User::query()->find($id);

        if ($user->hasVerifiedEmail()) {
            throw new ApiException(trans('auth.verify.already'), Response::HTTP_OK);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function resend(string $email): bool
    {
        /** @var User $user */
        $user = User::query()
            ->where('email', $email)
            ->first();

        if ($user->hasVerifiedEmail()) {
            throw new ApiException(trans('auth.verify.already'), Response::HTTP_OK);
        }
        $user->sendEmailVerificationNotification();

        return true;
    }
}
