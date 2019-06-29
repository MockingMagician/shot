<?php

namespace MockingMagician\Shot\Exceptions;


use Throwable;

class ServiceIdDuplicateException extends \Exception
{
    public function __construct(string $serviceId, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Service with id `%s` is already defined', $serviceId);
        parent::__construct($message, $code, $previous);
    }
}
