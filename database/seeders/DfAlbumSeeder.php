<?php

namespace Database\Seeders;

use App\Models\Albums\Album;
use Illuminate\Database\Seeder;

class DfAlbumSeeder extends Seeder
{
    /**
     * @var int $userId
     */
    private $userId;

    /**
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function run(): ?bool
    {
        try {
            $data = [
                'user_id' => $this->userId,
                'name' => trans('defaults.album')
            ];
            Album::create($data);

            return true;
        } catch (\Exception $e) {
            throw new \Exception(trans('exceptions.no_album_created'));
        }
    }
}
