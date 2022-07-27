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
            'https://127.0.0.1:8001/api/v1/products'
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }

    public function getData($id): array{
        
        $response = $this->client->request(
            'GET',
            "https://127.0.0.1:8001/api/v1/product/$id"
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }

    public function deleteData($id): array{
        
        $response = $this->client->request(
            'DELETE',
            "https://127.0.0.1:8001/api/v1/product/$id"
        );

        $content = $response->toArray();

        return $content;
    }

    public function postData($form): array{
        
        $response = $this->client->request(
            'POST',
            'https://127.0.0.1:8001/api/v1/product',[
                'json' => $form
            ]
        );

        $content = $response->toArray();

        return $content;
    }

    public function editData($form,$id): array{
        
        $response = $this->client->request(
            'POST',
            "https://127.0.0.1:8001/api/v1/product/$id",[
                'json' => $form
            ]
        );

        $content = $response->toArray();

        return $content;
    }
}