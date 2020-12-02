<?php

namespace App\Http\Resources\Albums;

use App\Helpers\Status;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class AlbumResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_private' => $this->is_private,
            'is_visibility' => $this->is_visibility,
            'status' => [
                'code' => $this->code,
                'name' => Status::getNameStatus($this->status)
            ],
            'user' => [
                'id' => $this->user_id
            ],
            'created' => (string)$this->created_at
        ];
    }
}
