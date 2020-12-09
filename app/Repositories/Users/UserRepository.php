<?php

namespace App\Repositories\Users;

use App\Interfaces\Users\UserRepositoryInterface;
use App\Models\Users\User;
use \Exception;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function find(int $id)
    {
        $item = User::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }
}
