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
}
