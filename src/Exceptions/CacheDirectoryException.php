<?php

namespace MockingMagician\Shot\Exceptions;


use Throwable;

class CacheDirectoryException extends \Exception
{
    public function __construct(string $cachePath, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('`%s` cache path is not writable.', $cachePath);
        parent::__construct($message, $code, $previous);
    }
}
