<?php

namespace MockingMagician\Shot\Exceptions;


use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class ServiceNotFound extends ServiceException implements NotFoundExceptionInterface
{
    public function __construct(string $id = "", int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Service %s is not found. It seems not yet initialized in container.');
        parent::__construct($message, $code, $previous);
    }
}
