<?php

namespace App\Interfaces\Comments;

use App\Models\Comments\Comment;

interface CommentServiceInterface
{
    /**
     * @param array $data
     * @param Comment|null $comment
     * @return Comment|null
     */
    public function save(array $data, Comment $comment = null): ?Comment;

    /**
     * @param Comment $comment
     * @return bool|null
     */
    public function remove(Comment $comment): ?bool;
}
