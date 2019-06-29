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
     * @return ServiceRegister
     * @throws ServiceIdDuplicateException
     */
    public function add(Service $service): ServiceRegister
    {
        if (isset($this->services[$service->getId()])) {
            throw new ServiceIdDuplicateException($service->getId());
        }

        $this->services[$service->getId()] = $service;

        return $this;
    }

    /**
     * @param string $serviceId
     * @return object
     * @throws ServiceNotDefinedException
     */
    public function getService(string $serviceId)
    {
        if (!isset($this->services[$serviceId])) {
            throw new ServiceNotDefinedException($serviceId);
        }

        return $this->services[$serviceId]->getService();
    }
}
