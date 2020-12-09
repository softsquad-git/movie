<?php

namespace App\Interfaces\Users;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);
}
