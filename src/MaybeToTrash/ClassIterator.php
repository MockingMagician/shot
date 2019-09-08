<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

use Iterator;

class ClassIterator extends \AppendIterator
{
    public function __construct(string ...$directoryPath)
    {
        parent::__construct();
        foreach ($directoryPath as $directory) {
            parent::append(new ClassFilterIterator(new \RecursiveDirectoryIterator($directory)));
        }
    }

    public function append(Iterator $iterator): void
    {
        if (!$iterator instanceof self) {
            throw new \UnexpectedValueException(\sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
