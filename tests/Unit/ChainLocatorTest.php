<?php

declare(strict_types=1);

namespace Test\Unit;

use App\ChainLocator;
use App\HttpClient;
use App\Ip;
use App\Location;
use App\Locator;
use Location;
use PHPUnit\Framework\TestCase;

class ChainLocatorTest extends TestCase
{
    public function testSuccess(): void
    {
        $locators = [
            $this->mockLocator(null),
            $this->mockLocator($expexted = new Location('Expected')),
            $this->mockLocator(null),
            $this->mockLocator($expexted = new Location('Other')),
        ];

        $locator = new ChainLocator(...$locators);
        $actual = $locator->locate(new Ip('8.8.8.8'));
        
        self::assertNotNull($actual);
        self::assertEquals($expexted, $actual);
    }
    
    public function mockLocator(?Location $location): Locator
    {
        $mock = $this->createMock(Locator::class);
        $mock->method('locate')->willReturn($location);
        return $mock;
    }
}