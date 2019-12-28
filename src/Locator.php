<?php

declare(strict_types=1);

namespace App;

interface Locator
{
    public function locate(Ip $ip): ?Location;
}