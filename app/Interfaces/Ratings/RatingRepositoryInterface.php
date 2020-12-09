<?php

namespace App\Interfaces\Ratings;

use App\Models\Ratings\Rating;

interface RatingRepositoryInterface
{
    /**
     * @param array $filters
     * @return float|null
     */
    public static function findAverage(array $filters): ?float;

    /**
     * @param int $id
     * @return Rating|null
     */
    public function find(int $id): ?Rating;

    /**
     * @param array $filters
     * @return Rating|null
     */
    public function findByOne(array $filters): ?Rating;
}
