<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetApiClient
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('PETSTORE_API_KEY');
        $this->baseUrl = 'https://petstore.swagger.io/v2';
    }

    protected function sendRequest(string $method, string $endpoint, array $data = [])
    {
        try {
            $response = Http::withHeaders([
                'api_key' => $this->apiKey,
            ])->withoutVerifying()->{$method}("{$this->baseUrl}{$endpoint}", $data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Błąd podczas komunikacji z API', [
                'method' => $method,
                'endpoint' => $endpoint,
                'data' => $data,
                'response' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('Wyjątek podczas komunikacji z API', [
                'method' => $method,
                'endpoint' => $endpoint,
                'data' => $data,
                'exception' => $e->getMessage(),
            ]);
        }
        return null;
    }

    public function getById($id)
    {
        return $this->sendRequest('get', "/pet/{$id}");
    }

    public function store(array $data)
    {
        return $this->sendRequest('post', '/pet', $data);
    }

    public function edit($id, array $data)
    {
        return $this->sendRequest('put', "/pet/{$id}", $data);
    }

    public function destroy($id)
    {
        return $this->sendRequest('delete', "/pet/{$id}");
    }
}