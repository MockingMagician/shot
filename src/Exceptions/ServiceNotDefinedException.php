<?php

namespace MockingMagician\Shot\Exceptions;

use Throwable;

class ServiceNotDefinedException extends \Exception
{
    public function __construct(string $serviceId, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Service with id `%s` is not defined', $serviceId);
        parent::__construct($message, $code, $previous);
    }
}
