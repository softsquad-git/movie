<?php

namespace App\Interfaces\Comments;

use App\Models\Comments\Comment;

interface CommentRepositoryInterface
{
    /**
     * @param int $id
     * @return Comment|null
     */
    public function find(int $id): ?Comment;

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return mixed
     */
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20);
}
