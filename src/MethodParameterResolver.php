<?php

namespace MockingMagician\Shot;


use MockingMagician\Shot\Exceptions\ParameterNotFoundException;
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

    /**
     * @return string
     * @throws ParameterNotFoundException
     */
    public function resolve(): string
    {
        $methodParameters = $this->methodReflection->getParameters();
        $params = [];
        $toMinusPosition = 0;
        foreach ($methodParameters as $methodParameter) {
            $paramPosition = $methodParameter->getPosition();
            $canBeNull = $methodParameter->allowsNull();
            $hasDefaultValue = $methodParameter->isDefaultValueAvailable();
            if (isset($this->parameterIterator[$paramPosition - $toMinusPosition])) {
                // TODO Maybe something to deal with it
                // $paramType = $methodParameter->getType();
                $params[] = $this->parameterIterator[$paramPosition - $toMinusPosition]->getValue();

                continue;
            }

            if ($hasDefaultValue) {
                $params[] = $methodParameter->getDefaultValue();
                ++$toMinusPosition;

                continue;
            }

            if ($canBeNull) {
                $params[] = null;
                ++$toMinusPosition;

                continue;
            }

            throw new ParameterNotFoundException($methodParameter->getName(), $this->methodReflection->getName());
        }

        return '(' . implode(', ', $params) . ')';
    }
}
