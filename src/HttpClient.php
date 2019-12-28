<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

class HttpClient
{
    public function get(string $url): ?string
    {
        $response = @file_get_contents($url);
        if($response === false) {
            throw new RuntimeException(error_get_last());
        }
        return $response;
    }
}
