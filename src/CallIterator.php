<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

class CallIterator extends \AppendIterator
{
    public function __construct(Call ...$calls)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($calls));
    }

    public function append(\Iterator $iterator): void
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(\sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
