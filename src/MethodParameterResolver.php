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

    public function resolve(): string
    {
        $methodParameters = $this->methodReflection->getParameters();
        $params = [];
        foreach ($methodParameters as $methodParameter) {
            $paramPosition = $methodParameter->getPosition();
            $canBeNull = $methodParameter->allowsNull();
            $hasDefaultValue = $methodParameter->isDefaultValueAvailable();
            if (isset($this->parameterIterator[$paramPosition])) {
                // TODO Maybe something to deal with it
                // $paramType = $methodParameter->getType();
                $params[] = $this->parameterIterator[$paramPosition];

                continue;
            }

            if ($hasDefaultValue) {
                $params[] = $methodParameter->getDefaultValue();

                continue;
            }

            if ($canBeNull) {
                $params[] = null;

                continue;
            }

            throw new \RuntimeException('Parameter is not set and can not be set');
        }

        return '(' . implode(', ', $params) . ')';
    }
}
