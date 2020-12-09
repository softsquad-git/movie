<?php

namespace App\Services\Ratings;

use App\Interfaces\Ratings\RatingServiceInterface;
use App\Models\Ratings\Rating;
use Illuminate\Support\Facades\Auth;
use \Exception;

class RatingService implements RatingServiceInterface
{
    /**
     * @param array $data
     * @param Rating|null $rating
     * @return Rating|null
     * @throws Exception
     */
    public function save(array $data, Rating $rating = null): ?Rating
    {
        $data['user_id'] = Auth::id();
        if ($rating) {
            throw new Exception(trans('exceptions.ratings_exists'));
        }

        return Rating::create($data);
    }

    /**
     * @param Rating $rating
     * @return bool|null
     * @throws \Exception
     */
    public function remove(Rating $rating): ?bool
    {
        return $rating->delete();
    }
}
