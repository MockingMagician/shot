<?php

namespace MockingMagician\Shot;

class Compiler
{
    /** @var CompilerConfig[] */
    private $configs;
    /** @var ServiceRegister */
    private $serviceRegister;

    public function __construct(CompilerConfig ...$configs)
    {
        $this->configs = $configs;
    }

    /** @throws Exceptions\ServiceIdDuplicateException */
    public function compile()
    {
        $this->generateServiceRegister();

        return $this->serviceRegister;
    }

    /**
     * @throws Exceptions\ServiceIdDuplicateException
     */
    private function generateServiceRegister()
    {
        $serviceRegister = new ServiceRegister();

        foreach ($this->configs as $config) {
            /** @var ManualDefined $manualDefined */
            foreach ($config->getManualDefinedIterator() as $manualDefined) {
                $id = $manualDefined->getId();
                $class = $manualDefined->getClass();
                $arguments = $manualDefined->getArguments();
                $methodToCall = $manualDefined->getCallMethod();
                $argumentsForMethod = $manualDefined->getArgumentsCallMethod();
                if (null === $id && null === $class) {
                    throw new \UnexpectedValueException('id and class must not both be null');
                }
                if (null === $id) {
                    $id = $class;
                }
                $service = new Service(
                    $id,
                    true,
                    function () use ($class, $arguments, $methodToCall, $argumentsForMethod) {
                        $class = new $class(...$arguments);
                        if (!\is_string($methodToCall)) {
                            return $class;
                        }

                        return $class->{$methodToCall}(...$argumentsForMethod);
                    }
                );
                $serviceRegister->add($service);
            }
        }

        $this->serviceRegister = $serviceRegister;
    }
}
