<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\VerifyServiceInterface;
use App\Models\Users\User;
use App\Models\Users\UserVerifyKey;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use \Exception;

class VerifyService implements VerifyServiceInterface
{
    /**
     * @param string $email
     * @return string
     * @throws Exception
     */
    public function keyGenerate(string $email): string
    {
        $verifyKey = Str::random(64);

        try {
            UserVerifyKey::create([
                'email' => $email,
                'verify_key' => $verifyKey,
                'ip_address' => Request::ip()
            ]);

            return $verifyKey;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $key
     * @param bool $isRemove
     * @return bool
     */
    public function checkKey(string $key, bool $isRemove = false): bool
    {
        //dd(UserVerifyKey::where('verify_key', $key)->first());
        if (!UserVerifyKey::where('verify_key', $key)->first())
            return false;
        if ($isRemove) {
            $this->remove($key);
            return true;
        }
        return true;
    }

    /**
     * @param string $key
     * @return User|null
     */
    public function getAccountFromKey(string $key): ?User
    {
         return User::where('email', UserVerifyKey::where('verify_key', $key)->first()->email)->first();
    }

    /**
     * @param string $key
     * @return bool|null
     */
    public function remove(string $key): ?bool
    {
        return UserVerifyKey::where('verify_key', $key)->first()->delete();
    }

}
