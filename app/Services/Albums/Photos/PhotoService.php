<?php

namespace App\Services\Albums\Photos;

use App\Interfaces\Albums\Photos\PhotoServiceInterface;
use App\Interfaces\Albums\AlbumRepositoryInterface as AlbumRepository;
use App\Models\Albums\Photo;
use \Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoService implements PhotoServiceInterface
{
    /**
     * @var AlbumRepository $albumRepository
     */
    private $albumRepository;

    /**
     * @param AlbumRepository $albumRepository
     */
    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    /**
     * @param array $data
     * @param Photo|null $photo
     * @return bool|null
     * @throws Exception
     */
    public function save(array $data, Photo $photo = null): ?bool
    {
        $album = $this->albumRepository->find($data['album_id']);
        $photosFilename = [];
        foreach ($data['photos'] as $photo) {
            $photosFilename[] = [
                'album_id' => $data['album_id'],
                'src' => $this->uploadPhoto($photo),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ];
        }
        try {
            $album->photos()->insert($photosFilename);

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Photo $photo
     * @return bool|null
     * @throws Exception
     */
    public function remove(Photo $photo): ?bool
    {
        return $photo->delete();
    }

    /**
     * @param $file
     * @return string
     * @throws Exception
     */
    private function uploadPhoto($file): string
    {
        $fileName = Str::random(64) . '.' . $file->getClientOriginalExtension();
        try {
            Storage::disk('photos')->put($fileName, File::get($file));

            return $fileName;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
