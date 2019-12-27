<?php

declare(strict_types=1);

namespace App;



use InvalidArgumentException;

class Ip
{
    private $value;
    
    public function __construct(string $ip)
    {
        if (empty($ip)) {
            throw new InvalidArgumentException('Empty Ip');
        }
    
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            throw new InvalidArgumentException('Ip not valid');
        }
        $this->value = $ip;
    }
    
    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}