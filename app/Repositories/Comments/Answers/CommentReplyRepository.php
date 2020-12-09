<?php

namespace App\Repositories\Comments\Answers;

use App\Interfaces\Comments\Answers\CommentReplyRepositoryInterface;
use App\Models\Comments\CommentReply;
use \Exception;

class CommentReplyRepository implements CommentReplyRepositoryInterface
{
    /**
     * @param int $id
     * @return CommentReply|null
     * @throws Exception
     */
    public function find(int $id): ?CommentReply
    {
        $item = CommentReply::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exception.no_found'));
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return mixed
     * @throws Exception
     */
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20)
    {
        if (!isset($filters['comment_id'])) {
            throw new Exception(trans('exceptions.empty_filters'));
        }

        return CommentReply::orderBy('id', $filters['ordering'] ?? $ordering)
            ->where([
                'comment_id' => $filters['comment_id']
            ])
            ->paginate($filters['pagination'] ?? $pagination);
    }
}
