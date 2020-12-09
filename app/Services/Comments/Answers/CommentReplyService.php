<?php

namespace App\Services\Comments\Answers;

use App\Interfaces\Comments\Answers\CommentReplyServiceInterface;
use App\Models\Comments\CommentReply;
use \Exception;
use Illuminate\Support\Facades\Auth;

class CommentReplyService implements CommentReplyServiceInterface
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'COMMENT_REPLY';

    /**
     * @param array $data
     * @param CommentReply|null $commentReply
     * @return CommentReply|null
     */
    public function save(array $data, CommentReply $commentReply = null): ?CommentReply
    {
        $data['user_id'] = Auth::id();
        if ($commentReply) {
            $commentReply->update($data);

            return $commentReply;
        }

        return CommentReply::create($data);
    }

    /**
     * @param CommentReply $commentReply
     * @return bool|null
     * @throws Exception
     */
    public function remove(CommentReply $commentReply): ?bool
    {
        return $commentReply->delete();
    }
}
