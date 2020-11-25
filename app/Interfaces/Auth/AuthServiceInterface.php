<?php

namespace App\Interfaces\Auth;

interface AuthServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function register(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function login(array $data);

    /**
     * @param string $key
     * @return mixed
     */
    public function activateAccount(string $key);
}
