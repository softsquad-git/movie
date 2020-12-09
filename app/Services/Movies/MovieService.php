<?php

namespace App\Services\Movies;

use App\Helpers\Status;
use App\Interfaces\Movies\MovieServiceInterface;
use App\Models\Movies\Movie;
use \Exception;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Categories\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class MovieService implements MovieServiceInterface
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'MOVIE';

    /**
     * @var string
     */
    const MOVIE_URL = 'movies/';

    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @param Movie|null $movie
     * @return Movie|null
     * @throws Exception
     */
    public function save(array $data, Movie $movie = null): ?Movie
    {
        $data['user_id'] = Auth::id();
        $this->categoryRepository->find($data['category_id']);

        if ($movie) {
            if (isset($data['file']) && !empty($data['file'])) {
                $data['src'] = $this->uploadFile($data['file']);
                $data['thumb'] = $this->saveThumbnails($data['src']);
            }
            $movie->update($data);

            return $movie;
        }

        DB::beginTransaction();
        try {
            $data['src'] = $this->uploadFile($data['file']);
            $data['thumb'] = $this->saveThumbnails($data['src']);
            $item = Movie::create($data);

            DB::commit();
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $file
     * @return string
     * @throws Exception
     */
    private function uploadFile($file): string
    {
        $fileName = Str::random(64).'.'.$file->getClientOriginalExtension();
        try {
            Storage::disk('movies')->put($fileName, File::get($file));

            return $fileName;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $path
     * @return string|null
     * @throws Exception
     */
    private function saveThumbnails(string $path): ?string
    {
        $fileName = Str::random(32).'.png';
        try {
            FFMpeg::fromDisk('movies')
                ->open($path)
                ->getFrameFromSeconds(10)
                ->export()
                ->toDisk('movies_thumbs')
                ->save($fileName);

            return $fileName;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Movie $movie
     * @return bool|null
     * @throws Exception
     */
    public function remove(Movie $movie): ?bool
    {
        return $movie->delete();
    }

    /**
     * @param Movie $movie
     * @return bool|null
     */
    public function archive(Movie $movie): ?bool
    {
        if ($movie->status == Status::ON) {
            $movie->update(['status' => Status::OFF]);
            return true;
        }

        if ($movie->status == Status::OFF) {
            $movie->update(['status' => Status::ON]);
            return true;
        }

        return false;
    }
}
