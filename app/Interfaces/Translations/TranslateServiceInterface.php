<?php

namespace App\Interfaces\Translations;

interface TranslateServiceInterface
{
    /**
     * @param array $data
     * @param null $class
     * @return mixed
     */
    public function create(array $data, $class = null);

    /**
     * @param array $data
     * @param $class
     * @return mixed
     */
    public function update(array $data, $class);
}
