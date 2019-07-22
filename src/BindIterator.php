<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

use Iterator;

class BindIterator extends \AppendIterator
{
    public function __construct(Bind ...$binds)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($binds));
    }

    public function append(Iterator $iterator): void
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(\sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
