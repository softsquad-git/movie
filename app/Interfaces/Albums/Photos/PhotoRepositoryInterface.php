<?php

namespace App\Interfaces\Albums\Photos;

use App\Models\Albums\Photo;

interface PhotoRepositoryInterface
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
     * @return Photo|null
     */
    public function find(int $id): ?Photo;

    /**
     * @param array $filters
     * @return Photo|null
     */
    public function findByOne(array $filters): ?Photo;
}
