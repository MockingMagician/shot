<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

class CompilerConfig
{
    private $serviceDefinitionIterator;
    private $classIterator;
    private $bindIterator;

    public function __construct(
        ?ServiceDefinitionIterator $serviceDefinitionIterator,
        ?ClassIterator $classIterator,
        ?BindIterator $bindIterator
    ) {
        $this->serviceDefinitionIterator = $serviceDefinitionIterator;
        $this->classIterator = $classIterator;
        $this->bindIterator = $bindIterator;
    }

    public function getServiceDefinitionIterator(): ?ServiceDefinitionIterator
    {
        return $this->serviceDefinitionIterator;
    }

    public function getClassIterator(): ?ClassIterator
    {
        return $this->classIterator;
    }

    public function getBindIterator(): ?BindIterator
    {
        return $this->bindIterator;
    }
}
