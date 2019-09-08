<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

class ServiceDefinition
{
    private $id;
    private $class;
    private $isSingleton;
    private $calls;

    public function __construct(
        ?string $id,
        ?string $class,
        bool $isSingleton,
        CallIterator $calls
    ) {
        $this->id = $id;
        $this->class = $class;
        $this->isSingleton = $isSingleton;
        $this->calls = $calls;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function isSingleton(): bool
    {
        return $this->isSingleton;
    }

    public function getCalls(): CallIterator
    {
        return $this->calls;
    }
}
