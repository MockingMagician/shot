<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\Exceptions;

use Throwable;

class ServiceNotDefinedException extends \Exception
{
    public function __construct(string $serviceId, int $code = 0, Throwable $previous = null)
    {
        $message = \sprintf('Service with id `%s` is not defined', $serviceId);
        parent::__construct($message, $code, $previous);
    }
}
