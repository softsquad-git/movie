<?php

namespace App\Repositories\Ratings;

use App\Interfaces\Ratings\RatingRepositoryInterface;
use App\Models\Ratings\Rating;
use \Exception;

class RatingRepository implements RatingRepositoryInterface
{
    /**
     * @param int $id
     * @return Rating|null
     * @throws Exception
     */
    public function find(int $id): ?Rating
    {
        $item = Rating::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(trans('exceptions.no_found'));
    }

    /**
     * @param array $filters
     * @return float|null
     */
    public static function findAverage(array $filters): ?float
    {
        $data = Rating::where($filters)->get();
        $countRecords = count($data);
        $sumRating = 0;
        foreach ($data as $datum) {
            $sumRating += $datum->rating;
        }

        return $sumRating / $countRecords;
    }

    /**
     * @param array $filters
     * @return Rating|null
     */
    public function findByOne(array $filters): ?Rating
    {
        return Rating::where($filters)->first();
    }
}
