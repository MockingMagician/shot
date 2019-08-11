<?php

namespace MockingMagician\Shot;


use ReflectionMethod;

class MethodParameterResolver
{
    private $methodReflection;
    private $parameterIterator;

    public function __construct(
        ReflectionMethod $methodReflection,
        ParameterIterator $parameterIterator
    ) {
        $this->methodReflection = $methodReflection;
        $this->parameterIterator = $parameterIterator;
    }

    public function resolve()
    {
        $methodName = $this->methodReflection->getName();
        $methodParameters = $this->methodReflection->getParameters();
        $params = [];
        foreach ($methodParameters as $methodParameter) {
            $paramPosition = $methodParameter->getPosition();
            if ($this->parameterIterator->getArrayIterator()->offsetGet($paramPosition)) {

            }
            $canBeNull = $methodParameter->allowsNull();
            $paramType = $methodParameter->getType();
            $hasDefaultValue = $methodParameter->isDefaultValueAvailable();
        }
    }
}
