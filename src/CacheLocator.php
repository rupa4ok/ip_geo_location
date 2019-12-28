<?php

declare(strict_types=1);

namespace App;

class CacheLocator implements Locator
{
    private $next;
    private $cache;
    private $ttl;
    
    public function __construct(Locator $next, Cache $cache, int $ttl)
    {
        $this->next = $next;
        $this->cache = $cache;
        $this->ttl = $ttl;
    }
    
    public function locate(Ip $ip): ?Location
    {
        $key = 'location-' . $ip->getValue();
        $location = $this->cache->get($key);
        
        if ($location === null) {
            $location = $this->next->locate($ip);
            $this->cache->set($key, $location, $this->ttl);
        }
        return $location;
    }
}
