<?php

declare(strict_types=1);

namespace App;

class ChainLocator implements Locator
{
    private $locators;
    
    public function __construct(Locator ...$locators)
    {
        $this->locators = $locators;
    }
    
    public function locate(Ip $ip): ?Location
    {
        foreach ($this->locators as $locator) {
            $location = $locator->locate($ip);
            if ($location !== null) {
                return $location;
            }
        }
        return null;
    }
}
