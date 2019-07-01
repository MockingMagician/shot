<?php

namespace MockingMagician\Shot;

class ManualDefinedIterator extends \ArrayIterator
{
    public function __construct(ManualDefined ...$manualDefineds)
    {
        parent::__construct($manualDefineds);
    }
}
