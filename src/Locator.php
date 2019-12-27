<?php

declare(strict_types=1);

namespace App;

class Locator
{
    public function locate(Ip $ip): ?Location
    {
        $url = 'https://api.ipgeolocation.io/ipgeo?' . http_build_query([
                'apiKey' => '6b19f7a24fa749d183617586a80dd462',
                'ip' => $ip->getValue()
            ]);
        
        $response = file_get_contents($url);
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