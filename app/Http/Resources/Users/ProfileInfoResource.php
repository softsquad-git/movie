<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ProfileInfoResource extends JsonResource
{
    public function toArray($request)
    {
        $isBirthday = 1;
        $birthday = null;
        if ($isBirthday === 1) {
            $birthday = $this->birthday;
        }
        $isEmailView = 1;
        $email = null;
        if ($isEmailView === 1) {
            $email = $this->email;
        }
        return [
            'id' => $this->id,
            'name' => $this->info->username ?? $this->getFullName(),
            'birthday' => $birthday,
            'created_at' => (string)$this->created_at,
            'email' => $email,
            'avatar' => asset('avatars/'.$this->avatar->src),
        ];
    }
}
