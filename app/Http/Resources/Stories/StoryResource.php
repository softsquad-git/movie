<?php

namespace App\Http\Resources\Stories;

use App\Helpers\Status;
use App\Repositories\Likes\LikeRepository;
use App\Services\Stories\StoryService;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class StoryResource extends JsonResource
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
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name
            ],
            'content' => $this->content,
            'is_rating' => $this->is_rating,
            'is_comment' => $this->is_comment,
            'status' => [
                'code' => $this->status,
                'name' => Status::getNameStatus($this->status)
            ],
            'user' => [
              'id' => $this->user_id,
              'name' => $this->user->info->username ?? $this->user->getFullName()
            ],
            'created_at' => (string)$this->created_at,
            'like' => [
                'count' => count($this->likes),
                'is_like' => LikeRepository::checkLike([
                    'resource_id' => $this->id,
                    'resource_type' => StoryService::RESOURCE_TYPE,
                    'user_id' => $this->user_id
                ])
            ],
        ];
    }
}
