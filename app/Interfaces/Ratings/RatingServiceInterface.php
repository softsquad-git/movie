<?php

namespace App\Interfaces\Ratings;

use App\Models\Ratings\Rating;

interface RatingServiceInterface
{
    /**
     * @param array $data
     * @param Rating|null $rating
     * @return Rating|null
     */
    public function save(array $data, Rating $rating = null): ?Rating;

    /**
     * @param Rating $rating
     * @return bool|null
     */
    public function remove(Rating $rating): ?bool;
}
