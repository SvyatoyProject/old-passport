<?php

namespace App\Services\Auth;

use App\Exceptions\ApiException;

/**
 * @link AuthService
*/
interface AuthInterface
{
    /**
     * Account login
     *
     * @param array $data
     * @return string
     * @throws ApiException
     * @link AuthService::login()
     */
    public function login(array $data): string;

    /**
     * Account registration
     *
     * @param array $data
     * @return bool
     * @link AuthService::register()
     */
    public function register(array $data): bool;

    /**
     * Verify email
     *
     * @param int $id
     * @return bool
     * @throws ApiException
     * @link AuthService::verify()
     */
    public function verify(int $id): bool;

    /**
     * Resend link to verify email
     *
     * @param string $email
     * @return bool
     * @throws ApiException
     * @link AuthService::resend()
     */
    public function resend(string $email): bool;
}
