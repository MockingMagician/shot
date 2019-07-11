<?php

namespace MockingMagician\Shot;


class CallIterator extends \AppendIterator
{
    public function __construct(Call ...$calls)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($calls));
    }

    public function append(\Iterator $iterator)
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}