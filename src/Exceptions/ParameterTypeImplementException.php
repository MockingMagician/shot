<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\Exceptions;

use Throwable;

class ParameterTypeImplementException extends \Exception
{
    public function __construct($parameter, int $code = 0, Throwable $previous = null)
    {
        $parameter = var_export($parameter, true);
        $message = \sprintf('Parameter defined as is : `%s` is not yet implemented or just can not be.', $parameter);
        parent::__construct($message, $code, $previous);
    }
}
