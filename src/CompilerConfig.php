<?php

namespace MockingMagician\Shot;


class CompilerConfig
{
    /** @var ManualDefinedIterator|null */
    private $manualDefinedIterator;
    /** @var ClassIterator|null */
    private $classIterator;
    /** @var string[] */
    private $binds;

    public function __construct(
        ?ManualDefinedIterator $manualDefinedIterator,
        ?ClassIterator $classIterator,
        string ...$binds
    ) {

        $this->manualDefinedIterator = $manualDefinedIterator;
        $this->classIterator = $classIterator;
        $this->binds = $binds;
    }
}
