<?php

declare(strict_types=1);

namespace App;

class ApiInfoLocator implements Locator
{
    private $client;
    private $apiKey;
    
    public function __construct(HttpClient $client, string $apiKey = '6b19f7a24fa749d183617586a80dd462')
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }
    
    public function locate(Ip $ip): ?Location
    {
        $url = 'https://api.ipgeolocation.io/ipgeo?' . http_build_query([
                'apiKey' => $this->apiKey,
                'ip' => $ip->getValue()
            ]);
        
        $response = $this->client->get($url);
        $data = json_decode($response, true);
        $data = array_map(function ($value) {
            return $value !== '-' ? $value : null;
        }, $data);
        
        if (empty($data['country_name'])) {
            return null;
        }
        
        return new Location(
            $data['country_name'],
            $data['state_prov'],
            $data['city']
        );
    }
}