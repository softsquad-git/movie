<?php

namespace App\Interfaces\Categories;

interface CategoryRepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param array $filters
     * @param string|null $ordering
     * @param int|null $pagination
     * @return mixed
     */
    public function findBy(array $filters, ?string $ordering = 'DESC', ?int $pagination = 20);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters);
}
