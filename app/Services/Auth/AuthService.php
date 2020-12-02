<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\AuthServiceInterface;
use App\Models\Users\User;
use \Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Mail\MailServiceInterface as MailService;
use App\Interfaces\Auth\VerifyServiceInterface as VerificationService;

class AuthService implements AuthServiceInterface
{
    /**
     * @var MailService $mailService
     */
    private $mailService;

    /**
     * @var VerificationService
     */
    private $verificationService;

    /**
     * @param MailService $mailService
     * @param VerificationService $verificationService
     */
    public function __construct(MailService $mailService, VerificationService $verificationService)
    {
        $this->mailService = $mailService;
        $this->verificationService = $verificationService;
    }

    /**
     * @param array $data
     * @return array|mixed
     * @throws Exception
     */
    public function login(array $data)
    {
        $loginData = [
            'email' => $data['email'],
            'passport' => $data['password']
        ];

        $user = User::where('email', $loginData['email'])->first();
        if ($user) {
            if (Hash::check($loginData['passport'], $user->password)) {
                return [
                    'access_token' => $user->createToken(config('app.name'))->accessToken,
                    'user_id' => $user->id,
                    'name' => $user->getFullName(),
                    'is_verified' => $user->is_verified
                ];
            }

            throw new Exception(trans('messages.error.user_password_account'));
        }

        throw new Exception(trans('messages.error.user_no_exists'));
    }

    /**
     * @param array $data
     * @return mixed|void
     * @throws Exception
     */
    public function register(array $data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $data['info']['user_id'] = $user->id;
            $user->info()->create($data['info']);
            $user->avatar()->create([
                'user_id' => $user->id,
                'src' => 'df.png'
            ]);
            $verificationKey = $this->verificationService->keyGenerate($user->email);
            $this->mailService
                ->setTo($user->email)
                ->setSubject(trans('mail.register'))
                ->setTemplate('success-register')
                ->setBody([
                    'name' => $user->getFullName(),
                    'created' => $user->created_at,
                    'key' => $verificationKey
                ])
                ->send();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $key
     * @return bool|null
     * @throws Exception
     */
    public function activateAccount(string $key): ?bool
    {
        if (!$this->verificationService->checkKey($key)) {
            throw new Exception(trans('messages.verification_failed_no_activate'));
        }
        $user = $this->verificationService->getAccountFromKey($key);
        $user->update(['is_verified' => true]);
        $this->verificationService->remove($key);
        $this->mailService
            ->setTo($user->email)
            ->setSubject(trans('mail.welcome'))
            ->setTemplate('welcome')
            ->setBody([
                'name' => $user->getFullName()
            ])
            ->send();
        return true;
    }
}
