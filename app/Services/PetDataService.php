<?php

namespace App\Services;

class PetDataService
{
    public function getCategories()
    {
        return [
            ['id' => 1, 'name' => 'Pies'],
            ['id' => 2, 'name' => 'Kot'],
            ['id' => 3, 'name' => 'Ptak'],
        ];
    }

    public function getTags()
    {
        return [
            ['id' => 1, 'name' => 'Miły'],
            ['id' => 2, 'name' => 'Spokojny'],
            ['id' => 3, 'name' => 'Agresywny'],
        ];
    }
}