<?php

namespace MockingMagician\Shot;


class ManualDefined
{
    /** @var null|string */
    private $id;
    /** @var null|string */
    private $class;
    /** @var string[] */
    private $arguments;
    /** @var string */
    private $callMethod;
    /** @var string[] */
    private $argumentsCallMethod;

    public function __construct(
        ?string $id,
        ?string $class,
        array $arguments = [],
        string $callMethod,
        array $argumentsCallMethod = []
    ) {
        $this->id = $id;
        $this->class = $class;
        $this->arguments = $arguments;
        $this->callMethod = $callMethod;
        $this->argumentsCallMethod = $argumentsCallMethod;
    }
}
