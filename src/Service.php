<?php

namespace MockingMagician\Shot;


use MockingMagician\Shot\Exceptions\ServiceException;

class Service implements ServiceInterface
{
    private $register;
    private $id;
    private $classOrStaticClassMethodOrCallable;
    private $args;
    /** @var bool */
    private $isSingleton = true;
    /** @var mixed */
    private $defined = null;
    /** @var bool */
    private $isClosure = true;

    public function __construct(ServiceRegisterInterface $register, string $id, $classOrStaticClassMethodOrCallable, array $args = [])
    {
        $this->id = $id;
        $this->classOrStaticClassMethodOrCallable = $classOrStaticClassMethodOrCallable;
        $this->args = $args;
        $this->register = $register;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @throws ServiceException
     */
    public function getDefined()
    {
        $defined = $this->define();

        if ($this->isClosure) {
            return ($this->defined[0])($this->defined[1]);
        }

        return $defined;
    }

    /**
     * @throws ServiceException
     */
    private function define()
    {
        if ($this->isSingleton() && null !== $this->defined) {

            return $this->defined;
        }

        if ($this->isSingleton()) {
            $this->defined = $this->resolve();

            return $this->defined;
        }

        return $this->resolve();
    }

    public function isSingleton(?bool $bool = null): bool
    {
        if (null !== $bool) {
            $this->isSingleton = $bool;
        }

        return $this->isSingleton;
    }

    /**
     * @throws ServiceException
     */
    protected function resolve()
    {
        if (preg_match(
            '#^([a-z][a-z0-9]*)::([a-z][a-z0-9]*)$#i',
            $this->classOrStaticClassMethodOrCallable,
            $matches
        )) {
            return $this->resolveStaticMethod($matches[1], $matches[2]);
        }
    }

    /**
     * @param string $class
     * @param string $method
     * @return mixed
     * @throws ServiceException
     */
    private function resolveStaticMethod(string $class, string $method)
    {
        $this->isClosure = true;
        $this->isSingleton(true);
        try {
            $rm = new \ReflectionMethod($class, $method);
        } catch (\Throwable $e) {
            $exception = new ServiceException($e->getMessage(), $e->getCode(), $e);

            throw $exception;
        }
        if (!$rm->isStatic()) {
            throw new ServiceException(sprintf('Method %s::%s() is not static', $class, $method));
        }
        if (!$rm->isPublic()) {
            throw new ServiceException(sprintf('Method %s::%s() is not public', $class, $method));
        }

        return [$rm->getClosure(), $this->resoleArguments($rm->getParameters(), $this->args)];
    }

    /**
     * @param \ReflectionParameter[] $reflectionParameters
     * @param array $inputArgs
     * @return array
     * @throws ServiceException
     */
    private function resoleArguments(array $reflectionParameters, array $inputArgs): array
    {
        $args = [];
        foreach ($reflectionParameters as $parameter) {
            if (isset($inputArgs[$parameter->getName()])) {
                $args[$parameter->getPosition()] = $this->resolveInputArg($inputArgs[$parameter->getName()]);
            }
            if (isset($inputArgs[$parameter->getPosition()])) {
                $args[$parameter->getPosition()] = $this->resolveInputArg($inputArgs[$parameter->getPosition()]);
            }
            if ($parameter->isDefaultValueAvailable()) {
                $args[$parameter->getPosition()] = $parameter->getDefaultValue();
            }

            throw new ServiceException(sprintf('Can not resolve argument %s', $parameter->getName()));
        }

        return $args;
    }

    private function resolveInputArg($argument)
    {
        if (is_string($argument) && preg_match('#^@(.+)$#', $argument, $matches)) {
            return $this->register->getService($matches[1]);
        }
        if (is_string($argument) && preg_match('#^(\@)(.+)$#', $argument, $matches)) {
            return '@'.$matches[2];
        }

        return $argument;
    }
}
