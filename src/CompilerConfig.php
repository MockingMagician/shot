<?php

namespace MockingMagician\Shot;

class CompilerConfig
{
    /** @var null|ManualDefinedIterator */
    private $manualDefinedIterator;
    /** @var null|ClassIterator */
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

    public function getManualDefinedIterator(): ?ManualDefinedIterator
    {
        return $this->manualDefinedIterator;
    }

    public function getClassIterator(): ?ClassIterator
    {
        return $this->classIterator;
    }

    public function getBinds(): array
    {
        return $this->binds;
    }
}
