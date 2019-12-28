<?php

declare(strict_types=1);

namespace App;

class ChainLocator implements Locator
{
    private $handler;
    private $locators;
    
    public function __construct(ErrorHandler $handler, Locator ...$locators)
    {
        $this->handler = $handler;
        $this->locators = $locators;
    }
    
    public function locate(Ip $ip): ?Location
    {
        $result = null;
        foreach ($this->locators as $locator) {
            try {
                $location = $locator->locate($ip);
            } catch (\Exception $exception) {
                $this->handler->handle($exception);
                return null;
            }
            if ($location === null) {
                continue;
            }
            if ($location->getCity() !== null) {
                return $location;
            }
            if ($result === null && $location->getRegion() !== null) {
                $result = $location;
                continue;
            }
            if ($result === null || $location->getRegion() === null) {
                $result = $location;
            }
        }
        return $result;
    }
}
