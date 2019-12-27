<?php

declare(strict_types=1);

namespace App;

class Location
{
    private $country;
    private $city;
    private $region;
    
    public function __construct(string $country, ?string $city, ?string $region)
    {
        $this->country = $country;
        $this->city = $city;
        $this->region = $region;
    }
    
    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
    
    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
    
    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }
    
    
}