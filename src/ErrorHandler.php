<?php

declare(strict_types=1);

namespace App;

use Psr\Log\LoggerInterface;

class ErrorHandler
{
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function handle(\Exception $exception): void
    {
        $this->logger->error($exception->getMessage(), [
            'exception' => $exception
        ]);
    }
}
