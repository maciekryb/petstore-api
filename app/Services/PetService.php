<?php


namespace App\Services;

use App\Clients\PetApiClient;

class PetService
{
    public function __construct(private PetApiClient $petApiClient) {}

    public function store($data)
    {
        $preparedData =  [
            // 'id' => $data['id'],
            'name' => $data['name'],
            // 'category' => [
            //     'id' => $data['category_id'],
            //     'name' => $this->getCategoryName($data['category_id']),
            // ],
            'photoUrls' => explode(',', $data['photoUrls']),
            // 'tags' => $tags,  // Zmieniliśmy na tablicę z tagiem
            // 'status' => $data['status'],
        ];



        $response = $this->petApiClient->store($preparedData);
        return $response;
    }
}
