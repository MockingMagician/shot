<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\Exceptions;

use Throwable;

class ProtectedException extends \Exception
{
    public function __construct(string $class, string $method, int $code = 0, Throwable $previous = null)
    {
        $message = \sprintf('`%s::%s` is protected or private and can not be called from outside', $class, $method);
        parent::__construct($message, $code, $previous);
    }
}
