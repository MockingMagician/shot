<?php

namespace MockingMagician\Shot;

use MockingMagician\Shot\Exceptions\ServiceIdDuplicateException;
use MockingMagician\Shot\Exceptions\ServiceNotDefinedException;

class ServiceRegister
{
    /** @var Service[] */
    private $services;

    /**
     * @param Service $service
     *
     * @throws ServiceIdDuplicateException
     *
     * @return ServiceRegister
     */
    public function add(Service $service): self
    {
        if (isset($this->services[$service->getId()])) {
            throw new ServiceIdDuplicateException($service->getId());
        }

        $this->services[$service->getId()] = $service;

        return $this;
    }

    /**
     * @param string $serviceId
     *
     * @throws ServiceNotDefinedException
     *
     * @return object
     */
    public function getService(string $serviceId)
    {
        if (!isset($this->services[$serviceId])) {
            throw new ServiceNotDefinedException($serviceId);
        }

        return $this->services[$serviceId]->getService();
    }
}
