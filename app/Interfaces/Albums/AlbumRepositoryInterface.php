<?php

namespace App\Interfaces\Albums;

use App\Models\Albums\Album;

interface AlbumRepositoryInterface
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
     * @param int $id
     * @return Album|null
     */
    public function find(int $id): ?Album;

    /**
     * @param array $filters
     * @return Album|null
     */
    public function findByOne(array $filters): ?Album;
}
