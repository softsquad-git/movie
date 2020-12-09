<?php

namespace App\Http\Resources\Comments\Answers;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CommentAnswersResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'comment_id' => $this->comment_id,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->info->username ?? $this->user->getFullName(),
                'avatar' => asset('avatars/' . $this->user->avatar->src)
            ],
            'content' => $this->content,
            'created_at' => (string)$this->created_at
        ];
    }
}
