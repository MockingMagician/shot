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
    /** @var bool */
    private $isSingleton;

    public function __construct(
        ?string $id,
        ?string $class,
        bool $isSingleton = false,
        array $arguments = [],
        ?string $callMethod = null,
        array $argumentsCallMethod = []
    ) {
        $this->id = $id;
        $this->class = $class;
        $this->arguments = $arguments;
        $this->callMethod = $callMethod;
        $this->argumentsCallMethod = $argumentsCallMethod;
        $this->isSingleton = $isSingleton;
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return string[]
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function getCallMethod(): ?string
    {
        return $this->callMethod;
    }

    /**
     * @return string[]
     */
    public function getArgumentsCallMethod(): array
    {
        return $this->argumentsCallMethod;
    }

    /**
     * @return bool
     */
    public function isSingleton(): bool
    {
        return $this->isSingleton;
    }
}
