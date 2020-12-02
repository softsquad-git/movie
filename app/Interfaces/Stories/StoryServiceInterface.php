<?php

namespace App\Interfaces\Stories;

use App\Models\Stories\Story;

interface StoryServiceInterface
{
    /**
     * @param array $data
     * @param Story|null $story
     * @return Story|null
     */
    public function save(array $data, Story $story = null): ?Story;

    /**
     * @param Story $story
     * @return bool|null
     */
    public function remove(Story $story): ?bool;

    /**
     * @param Story $story
     * @return bool|null
     */
    public function archive(Story $story): ?bool;
}
