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

class ServiceRegister implements ServiceRegisterInterface
{
    /** @var Service[] */
    private $services;

    /**
     * @param $classOrStaticClassMethodOrFunction
     * @param array $args
     * @param string|null $id
     * @param bool|null $isSingleton
     * @return ServiceRegister
     * @throws ServiceIdDuplicateException
     */
    public function createService(
        $classOrStaticClassMethodOrFunction,
        array $args = [],
        ?string $id = null,
        ?bool $isSingleton = null
    ): self {
        if (null === $id) {
            $id = $classOrStaticClassMethodOrFunction;
        }

        if (isset($this->services[$id])) {
            throw new ServiceIdDuplicateException($id);
        }

        $this->services[$id] = new Service($this, $id, $classOrStaticClassMethodOrFunction, $args);
        if (null != $isSingleton) {
            $this->services[$id]->isSingleton($isSingleton);
        }

        return $this;
    }

    /**
     * @param string $id
     * @return array|mixed|object
     * @throws Exceptions\ServiceException
     * @throws ServiceNotDefinedException
     */
    public function getService(string $id)
    {
        if (!isset($this->services[$id])) {
            throw new ServiceNotDefinedException($id);
        }

        return $this->services[$id]->getService();
    }
}
