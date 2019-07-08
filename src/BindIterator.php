<?php

namespace MockingMagician\Shot;


use Iterator;

class BindIterator extends \AppendIterator
{
    public function __construct(Bind ...$binds)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($binds));
    }

    public function append(Iterator $iterator)
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
