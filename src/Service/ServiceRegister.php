<?php

namespace MockingMagician\Shot\Service;


use MockingMagician\Shot\Exceptions\ServiceNotFound;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\SimpleCache\CacheInterface;

class ServiceRegister implements ContainerInterface
{
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function get($id)
    {
        $item = $this->cache->get($id);

        if (null === $item) {
            throw new ServiceNotFound($id);
        }

        return $item($this->cache);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function has($id)
    {
        $item = $this->cache->get($id);

        if (null === $item) {
            return false;
        }

        return true;
    }

    public function setService(ServiceRecorder $serviceInitializer)
    {
        $serviceInitializer->save($this->cache);
    }
}
