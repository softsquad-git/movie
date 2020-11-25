<?php

namespace App\Interfaces\Auth;

use App\Models\Users\User;

interface VerifyServiceInterface
{
    /**
     * @param string $email
     * @return string
     */
    public function keyGenerate(string $email): string;

    /**
     * @param string $key
     * @param bool $isRemove
     * @return bool
     */
    public function checkKey(string $key, bool $isRemove = false): bool;

    /**
     * @param string $key
     * @return User|null
     */
    public function getAccountFromKey(string $key): ?User;

    /**
     * @param string $key
     * @return mixed
     */
    public function remove(string $key);
}
