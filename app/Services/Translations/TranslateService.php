<?php

namespace App\Services\Translations;

use App\Interfaces\Translations\TranslateServiceInterface;

class TranslateService implements TranslateServiceInterface
{

    public function create(array $data, $class = null)
    {
       $class->insert($data);

       return true;
    }

    public function update(array $data, $class)
    {
        // TODO: Implement update() method.
    }
}
