<?php

namespace App\Interfaces\Stories;

use App\Models\Stories\Story;

interface StoryRepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return mixed
     */
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20);

    /**
     * @param array $filters
     * @return Story|null
     */
    public function findOneBy(array $filters): ?Story;

    /**
     * @param int $id
     * @return Story|null
     */
    public function find(int $id): ?Story;
}
