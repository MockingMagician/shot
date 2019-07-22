<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

class ServiceCompiler
{
    private $serviceDefinition;
    private $serviceRegister;
    private $bindIterator;

    public function __construct(
        ServiceDefinition $serviceDefinition,
        ServiceRegister $serviceRegister,
        BindIterator $bindIterator
    ) {
        $this->serviceDefinition = $serviceDefinition;
        $this->serviceRegister = $serviceRegister;
        $this->bindIterator = $bindIterator;
    }

    /**
     * @return ServiceDefinition
     */
    public function getServiceDefinition(): ServiceDefinition
    {
        return $this->serviceDefinition;
    }

    /**
     * @return ServiceRegister
     */
    public function getServiceRegister(): ServiceRegister
    {
        return $this->serviceRegister;
    }

    /**
     * @return BindIterator
     */
    public function getBindIterator(): BindIterator
    {
        return $this->bindIterator;
    }
}
