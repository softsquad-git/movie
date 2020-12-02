<?php

namespace App\Http\Resources\Movies;

use App\Helpers\Status;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class MovieResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name
            ],
            'is_rating' => $this->is_rating,
            'is_comment' => $this->is_comment,
            'src' => '',
            'status' => [
                'code' => $this->status,
                'name' => Status::getNameStatus($this->status)
            ],
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->info->username ?? $this->user->getFullName()
            ],
            'created_at' => (string)$this->created_at
        ];
    }
}
