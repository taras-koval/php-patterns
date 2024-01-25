<?php

namespace App\Structural\Adapter;

use GuzzleHttp\Client;

class GuzzleAdapter implements ClientInterface
{
    private Client $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new Client([
            'base_uri' => 'https://od-api.oxforddictionaries.com/api/v2/',
            'headers' => [
                'app_id' => '343adfb6',
                'app_key' => '2c77aa9f5dbf9c8590d53c9b35fd0940',
            ]
        ]);
    }
    
    public function get(string $url): array
    {
        $response = $this->guzzleClient->get($url);
        
        return json_decode($response->getBody()->getContents(), true);
    }
}
