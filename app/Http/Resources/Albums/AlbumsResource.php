<?php

namespace App\Http\Resources\Albums;

use App\Helpers\Status;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class AlbumsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $photos = $this->photos();
        if ($photo = $photos->first()) {
            $dfImg = asset('photos/'.$photo->src);
        } else {
            $dfImg = asset('photos/df.png');
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => (string)$this->created_at,
            'img' => $dfImg,
            'status' => [
                'code' => $this->status,
                'name' => Status::getNameStatus($this->status)
            ],
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->info->username ?? $this->user->getFullName()
            ],
            'is_private' => $this->is_private,
            'is_visibility' => $this->is_visibility
        ];
    }
}
