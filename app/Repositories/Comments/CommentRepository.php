<?php

namespace App\Repositories\Comments;

use App\Interfaces\Comments\CommentRepositoryInterface;
use App\Models\Comments\Comment;
use \Exception;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @param int $id
     * @return Comment|null
     * @throws Exception
     */
    public function find(int $id): ?Comment
    {
        $item = Comment::find($id);
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
        if (!isset($filters['resource_id']) || !isset($filters['resource_type'])) {
            throw new Exception(trans('exceptions.empty_filters'));
        }

        return Comment::orderBy('id', $filters['ordering'] ?? $ordering)
            ->where([
                'resource_id' => $filters['resource_id'],
                'resource_type' => $filters['resource_type']
            ])
            ->paginate($filters['pagination'] ?? $pagination);
    }
}
