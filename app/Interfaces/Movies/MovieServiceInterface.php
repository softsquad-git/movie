<?php

namespace App\Interfaces\Movies;

use App\Models\Movies\Movie;

interface MovieServiceInterface
{
    /**
     * @param array $data
     * @param Movie|null $movie
     * @return mixed
     */
    public function save(array $data, Movie $movie = null);

    /**
     * @param Movie $movie
     * @return bool|null
     */
    public function remove(Movie $movie): ?bool;

    /**
     * @param Movie $movie
     * @return bool|null
     */
    public function archive(Movie $movie): ?bool;
}
