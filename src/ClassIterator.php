<?php

namespace MockingMagician\Shot;


use Iterator;

class ClassIterator extends \AppendIterator
{
    public function __construct(string ...$directoryPaths)
    {
        foreach ($directoryPaths as $directoryPath)
        {
            parent::append(new ClassFilterIterator(new \RecursiveDirectoryIterator($directoryPath)));
        }
    }

    public function append(Iterator $iterator)
    {
        if (!$iterator instanceof ClassIterator) {
            throw new \UnexpectedValueException(sprintf('Expect %s', static::class));
        }

        static::append($iterator);
    }
}
