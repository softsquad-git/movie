<?php

namespace App\Interfaces\Movies;

use App\Models\Movies\Movie;

interface MovieRepositoryInterface
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
    public function findBy(array $filters, $ordering = 'DESC', $pagination = 20);

    /**
     * @param array $filters
     * @return Movie|null
     */
    public function findOnBy(array $filters): ?Movie;

    /**
     * @param int $id
     * @return Movie|null
     */
    public function find(int $id): ?Movie;
}
