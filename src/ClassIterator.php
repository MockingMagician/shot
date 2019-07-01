<?php

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

    public function append(Iterator $iterator)
    {
        if (!$iterator instanceof self) {
            throw new \UnexpectedValueException(sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
