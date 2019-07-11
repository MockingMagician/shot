<?php

namespace MockingMagician\Shot;


class ServiceDefinitionIterator extends \AppendIterator
{
    public function __construct(ServiceDefinition ...$serviceDefinitions)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($serviceDefinitions));
    }

    public function append(\Iterator $iterator)
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
