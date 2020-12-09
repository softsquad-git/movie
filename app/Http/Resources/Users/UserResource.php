<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => [
                'first' => $this->name,
                'last' => $this->last_name,
                'full' => $this->getFullName()
            ],
            'email' => $this->email,
            'birthday' => $this->birthday,
            'sex' => [
                'code' => $this->sex,
                'name' => ''
            ],
            'info' => new UserInfoResource($this->info),
            'avatar' => asset('avatars/'.$this->avatar->src),
            'created_at' => (string)$this->created_at
        ];
    }
}
