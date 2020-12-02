<?php

namespace App\Observers\Users;

use App\Models\Users\User;
use Database\Seeders\DfAlbumSeeder;
use \Exception;

class UserObserver
{
    /**
     * @param User $user
     * @throws Exception
     */
    public function created(User $user)
    {
        $dfAlbumSeeder = new DfAlbumSeeder($user->id);
        $dfAlbumSeeder->run();
    }
}
