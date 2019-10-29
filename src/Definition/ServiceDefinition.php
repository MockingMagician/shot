<?php

namespace MockingMagician\Shot\Definition;


use MockingMagician\Shot\Exceptions\ServiceException;

class ServiceDefinition
{
    /** @var bool */
    private $isSingleton = false;
    /** @var array */
    private $parameters = [];

    /**
     * ServiceDefinition constructor.
     * @param string $id
     * @param $classOrCallable
     * @throws ServiceException
     * @throws \ReflectionException
     */
    public function __construct(string $id, $classOrCallable)
    {
        if (!(class_exists($classOrCallable) || is_callable($classOrCallable))) {
            throw new ServiceException('Can not define a none callable or class');
        }

        if (class_exists($classOrCallable)) {
            $rc = new \ReflectionClass($classOrCallable);
            if (!$rc->isInstantiable()) {
                throw new ServiceException('Can not define a class that is not instantiable');
            }
        }
    }

    public function isSingleton(bool $isSingleton = null):bool
    {
        return $this->isSingleton = $isSingleton ?? $this->isSingleton;
    }

    public function bindParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}
