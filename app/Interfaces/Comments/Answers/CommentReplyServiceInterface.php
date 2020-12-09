<?php

namespace App\Interfaces\Comments\Answers;

use App\Models\Comments\CommentReply;

interface CommentReplyServiceInterface
{
    /**
     * @param array $data
     * @param CommentReply|null $commentReply
     * @return CommentReply|null
     */
    public function save(array $data, CommentReply $commentReply = null): ?CommentReply;

    /**
     * @param CommentReply $commentReply
     * @return bool|null
     */
    public function remove(CommentReply $commentReply): ?bool;
}
