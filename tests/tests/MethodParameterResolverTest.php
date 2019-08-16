<?php

use MockingMagician\Shot\MethodParameterResolver;
use MockingMagician\Shot\Parameter;
use MockingMagician\Shot\ParameterIterator;
use PHPUnit\Framework\TestCase;

class MethodParameterResolverTest extends TestCase
{
    /**
     * @throws ReflectionException
     * @throws \MockingMagician\Shot\Exceptions\ParameterNotFoundException
     * @throws \MockingMagician\Shot\Exceptions\ParameterTypeImplementException
     */
    public function testResolve()
    {
        $reflectionMethod = new ReflectionMethod(\MockingMagician\Shot\TestClasses\C::class, '__construct');
        $parameterIterator = new ParameterIterator(...[
            new Parameter('one'),
            new Parameter(\DateTime::class),
            new Parameter(\MockingMagician\Shot\TestClasses\B::class),
            new Parameter('other'),
        ]);

        $resolver = new MethodParameterResolver($reflectionMethod, $parameterIterator);
        $this->assertEquals('()', $resolver->resolve());
    }
}
