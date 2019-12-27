<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Ip;
use App\Locator;
use phpDocumentor\Reflection\Location;
use PHPUnit\Framework\TestCase;

class LocatorTest extends TestCase
{
    public function testSuccess(): void
    {
        $locator = new Locator();
        $location = $locator->locate(new Ip('8.8.8.8'));
        
        self::assertNotNull($location);
        self::assertEquals('United States', $location->getCountry());
        self::assertEquals('California', $location->getCity());
        self::assertEquals('Mountain View', $location->getRegion());
    }
    
    public function testNotFound(): void
    {
        $locator = new Locator();
        $location = $locator->locate(new Ip('127.0.0.1'));
        self::assertNull($location);
    }
}