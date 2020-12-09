<?php

namespace App\Services\Stories;

use App\Helpers\Status;
use App\Interfaces\Stories\StoryServiceInterface;
use App\Models\Stories\Story;
use Illuminate\Support\Facades\Auth;
use \Exception;

class StoryService implements StoryServiceInterface
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'STORY';

    /**
     * @param array $data
     * @param Story|null $story
     * @return Story|null
     */
    public function save(array $data, Story $story = null): ?Story
    {
        $data['user_id'] = Auth::id();
        if ($story) {
            $story->update($data);

            return $story;
        }

        $story = Story::create($data);

        return $story;
    }

    /**
     * @param Story $story
     * @return bool|null
     * @throws Exception
     */
    public function remove(Story $story): ?bool
    {
        return $story->delete();
    }

    /**
     * @param Story $story
     * @return bool
     */
    public function archive(Story $story): bool
    {
        if ($story->status == Status::ON) {
            $story->update(['status' => Status::OFF]);
            return true;
        }

        if ($story->status == Status::OFF) {
            $story->update(['status' => Status::ON]);
            return true;
        }

        return false;
    }
}
