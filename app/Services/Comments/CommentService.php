<?php

namespace App\Services\Comments;

use App\Interfaces\Comments\CommentServiceInterface;
use App\Models\Comments\Comment;
use \Exception;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentServiceInterface
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'COMMENT';

    /**
     * @param array $data
     * @param Comment|null $comment
     * @return Comment|null
     */
    public function save(array $data, Comment $comment = null): ?Comment
    {
        $data['user_id'] = Auth::id();
        if ($comment) {
            $comment->update($data);

            return $comment;
        }

        return Comment::create($data);
    }

    /**
     * @param Comment $comment
     * @return bool|null
     * @throws Exception
     */
    public function remove(Comment $comment): ?bool
    {
        return $comment->delete();
    }
}
