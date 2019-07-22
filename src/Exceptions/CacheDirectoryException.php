<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\Exceptions;

use Throwable;

class CacheDirectoryException extends \Exception
{
    public function __construct(string $cachePath, int $code = 0, Throwable $previous = null)
    {
        $message = \sprintf('`%s` cache path is not writable.', $cachePath);
        parent::__construct($message, $code, $previous);
    }
}
