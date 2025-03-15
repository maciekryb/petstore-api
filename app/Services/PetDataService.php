<?php

namespace App\Services;

class PetDataService
{
    private static array $categories = [
        ['id' => 1, 'name' => 'Pies'],
        ['id' => 2, 'name' => 'Kot'],
        ['id' => 3, 'name' => 'Ptak'],
    ];

    private static array $tags = [
        ['id' => 1, 'name' => 'Miły'],
        ['id' => 2, 'name' => 'Spokojny'],
        ['id' => 3, 'name' => 'Agresywny'],
    ];

    public function getCategories(): array
    {
        return self::$categories;
    }

    public function getTags(): array
    {
        return self::$tags;
    }

    public function getCategoryName(int $id): string
    {
        $category = collect(self::$categories)->firstWhere('id', $id);
        return $category['name'] ?? '';
    }

    public function getTagName(int $id): string
    {
        $tag = collect(self::$tags)->firstWhere('id', $id);
        return $tag['name'] ?? '';
    }
}