<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 13/08/19
 * Time: 23:00
 */

namespace MockingMagician\Shot\Exceptions;


use Throwable;

class ParameterNotFoundException extends \Exception
{
    public function __construct(string $parameterName, string $methodName, int $code = 0, Throwable $previous = null)
    {
        $message = \sprintf('`%s` parameter not found for `%s` method', $parameterName, $methodName);
        parent::__construct($message, $code, $previous);
    }

}