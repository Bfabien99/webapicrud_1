<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    public function getAllData(): array{
        
        $response = $this->client->request(
            'GET',
            'https://127.0.0.1:8000/api/v1/products'
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}