<?php

namespace App\Http\Resources\Albums\Photos;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class PhotosResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
          'id' => $this->id,
          'src' => asset('photos/'.$this->src),
          'created_at' => (string)$this->created_at
        ];
    }
}
