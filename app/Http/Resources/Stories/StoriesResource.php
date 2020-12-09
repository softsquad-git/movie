<?php

namespace App\Http\Resources\Stories;

use App\Helpers\Status;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class StoriesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_content' => substr($this->content, 0, 300),
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name
            ],
            'status' => [
                'code' => $this->status,
                'name' => Status::getNameStatus($this->status)
            ],
            'created_at' => (string)$this->created_at
        ];
    }
}
