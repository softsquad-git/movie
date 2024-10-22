<?php

namespace App\Http\Resources\Movies;

use App\Helpers\Status;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class MoviesResource extends JsonResource
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
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name
            ],
            'thumb' => asset('movies/thumbs/'.$this->thumb),
            'status' => [
                'code' => $this->status,
                'name' => Status::getNameStatus($this->status)
            ],
            'created_at' => (string)$this->created_at
        ];
    }
}
