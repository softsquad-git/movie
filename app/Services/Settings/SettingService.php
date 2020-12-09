<?php

namespace App\Services\Settings;

use App\Interfaces\Settings\SettingServiceInterface;
use App\Interfaces\Users\UserRepositoryInterface as UserRepository;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use \Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingService implements SettingServiceInterface
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User|null
     * @throws Exception
     */
    public function changeBasicData(array $data): ?User
    {
        $user = $this->userRepository->find(Auth::id());

        $user->update($data);
        $user->info()->update($data['info']);

        return $user;
    }

    /**
     * @param array $data
     * @return User|null
     * @throws Exception
     */
    public function changePassword(array $data): ?User
    {
        $user = $this->userRepository->find(Auth::id());

        if (Hash::check($data['old_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($data['new_password'])
            ]);

            return $user;
        }

        throw new Exception(trans('messages.error.invalid_password'));
    }

    public function changeEmail(array $data)
    {
        // TODO: Implement changeEmail() method.
    }

    public function changeEmailConfirm(array $data)
    {
        // TODO: Implement changeEmailConfirm() method.
    }

    /**
     * @param $file
     * @return User|null
     * @throws Exception
     */
    public function changeAvatar($file): ?User
    {
        $user = $this->userRepository->find(Auth::id());
        $fileName = Str::random(64) . '-'.$user->id.'.' . $file->getClientOriginalExtension();
        try {
            Storage::disk('avatars')->put($fileName, File::get($file));

            $user->avatar()->update([
                'src' => $fileName
            ]);

            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
