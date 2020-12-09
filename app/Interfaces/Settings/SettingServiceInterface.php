<?php

namespace App\Interfaces\Settings;

use App\Models\Users\User;

interface SettingServiceInterface
{
    /**
     * @param array $data
     * @return User|null
     */
    public function changeBasicData(array $data): ?User;

    /**
     * @param array $data
     * @return User|null
     */
    public function changePassword(array $data): ?User;

    /**
     * @param array $data
     * @return mixed
     */
    public function changeEmail(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function changeEmailConfirm(array $data);

    /**
     * @param $file
     * @return User|null
     */
    public function changeAvatar($file): ?User;
}
