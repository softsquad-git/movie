<?php

namespace App\Interfaces\Comments\Answers;

use App\Models\Comments\CommentReply;

interface CommentReplyRepositoryInterface
{
    /**
     * @param int $id
     * @return CommentReply|null
     */
    public function find(int $id): ?CommentReply;

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return mixed
     */
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20);
}
