<?php

declare(strict_types=1);

namespace Test\Unit;

use App\HttpClient;
use App\Ip;
use App\Locator;
use phpDocumentor\Reflection\Location;
use PHPUnit\Framework\TestCase;

class LocatorTest extends TestCase
{
    public function testSuccess(): void
    {
        $client = $this->createMock(HttpClient::class);
        $client->method('get')->willReturn(json_encode([
            'country_name' => 'United States',
            'state_prov' => 'California',
            'city' => 'Mountain View'
        ]));
        
        $locator = new Locator($client);
        $location = $locator->locate(new Ip('8.8.8.8'));
        
        self::assertNotNull($location);
        self::assertEquals('United States', $location->getCountry());
        self::assertEquals('California', $location->getCity());
        self::assertEquals('Mountain View', $location->getRegion());
    }
    
    public function testNotFound(): void
    {
        $client = $this->createMock(HttpClient::class);
        $client->method('get')->willReturn(json_encode([
            'country_name' => '-',
            'state_prov' => '-',
            'city' => '-'
        ]));
        $locator = new Locator($client);
        $location = $locator->locate(new Ip('127.0.0.1'));
        self::assertNull($location);
    }
}