<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

use MockingMagician\Shot\Exceptions\ServiceIdDuplicateException;
use MockingMagician\Shot\Exceptions\ServiceNotDefinedException;

class ServiceRegister
{
    /** @var Service__[] */
    private $services;

    /**
     * @param Service__ $service
     *
     * @throws ServiceIdDuplicateException
     *
     * @return ServiceRegister
     */
    public function add(Service__ $service): self
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
