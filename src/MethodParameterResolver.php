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
     * @throws Exceptions\ParameterTypeImplementException
     */
    public function resolve(): string
    {
        $methodParameters = $this->methodReflection->getParameters();
        $params = [];
        $toMinusPosition = 0;
        foreach ($methodParameters as $methodParameter) {
            $paramPosition = $methodParameter->getPosition();
//            var_dump($paramPosition);
//            continue;
            $canBeNull = $methodParameter->allowsNull();
            $hasDefaultValue = $methodParameter->isDefaultValueAvailable();
            var_dump([
                '$paramPosition' => $paramPosition,
                'resolve' => $this->parameterIterator[$paramPosition - $toMinusPosition]->resolve(),
                '$canBeNull' => $canBeNull,
                '$hasDefaultValue' => $hasDefaultValue,
                'defaultValue' => (new Parameter($methodParameter->getDefaultValue()))->resolve(),
            ]);
            if (isset($this->parameterIterator[$paramPosition - $toMinusPosition])) {
                // TODO Maybe something to deal with it
                // $paramType = $methodParameter->getType();
                $params[] = $this->parameterIterator[$paramPosition - $toMinusPosition]->resolve();

                continue;
            }

            if ($hasDefaultValue) {
                $params[] = (new Parameter($methodParameter->getDefaultValue()))->resolve();
                ++$toMinusPosition;

                continue;
            }

            if ($canBeNull) {
                $params[] = 'null';
                ++$toMinusPosition;

                continue;
            }

            throw new ParameterNotFoundException($methodParameter->getName(), $this->methodReflection->getName());
        }

        return '(' . implode(', ', $params) . ')';
    }
}
