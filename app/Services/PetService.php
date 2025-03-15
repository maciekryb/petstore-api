<?php


namespace App\Services;

use App\Clients\PetApiClient;

class PetService
{
    public function __construct(private PetApiClient $petApiClient, private PetDataService $petDataService) {}

    public function store($data)
    {
        $preparedData = $this->prepareData($data);

        $response = $this->petApiClient->store($preparedData);
        return $response;
    }

    private function prepareData($data)
    {
        $preparedData = [
            'name' => $data['name'],
            'photoUrls' => explode(',', $data['photoUrls']),
            'id' => $data['identificationNumber'] ?? null,
        ];

        if (!empty($data['category_id'])) {
            $preparedData['category'] = [
                'id' => $data['category_id'],
                'name' => $this->petDataService->getCategoryName($data['category_id']),
            ];
        }

        if (!empty($data['tag_id'])) {
            $preparedData['tags'] = [
                [
                    'id' => $data['tag_id'],
                    'name' => $this->petDataService->getTagName($data['tag_id']),
                ],
            ];
        }

        if(!empty($data['status'])) {
            $preparedData['status'] = $data['status'];
        }

        return $preparedData;
    }
}
