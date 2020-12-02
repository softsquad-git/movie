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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => (string) $this->created_at,
            'img' => 'https://cdn.quasar.dev/img/parallax2.jpg',
            'status' => [
                'code' => $this->status,
                'name' => Status::getNameStatus($this->status)
            ],
            'is_private' => $this->is_private,
            'is_visibility' => $this->is_visibility
        ];
    }
}
