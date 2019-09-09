<?php

namespace MockingMagician\Shot\Tests;


use MockingMagician\Shot\TestClasses\D;
use PHPStan\Testing\TestCase;

class TestClosureInstance extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testThat()
    {
        $rm = new \ReflectionMethod(D::class, 'isStatic');
        $closure = $rm->getClosure();
        $closure();
        $closure();
        $closure();
        static::assertInstanceOf(\Closure::class, $closure);
        try {
            new \ReflectionMethod(D::class, 'isStaticNope');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
        $rf = new \ReflectionFunction('mb_substr');
        echo "\n";
        echo $rf->getName()."\n";
        foreach ($rf->getParameters() as $parameter) {
            echo $parameter->getName()."\n";
        }
        echo ($rf->getClosure())('azerty', 0, 2)."\n";
        echo \Reflection::export($rm);
        echo \Reflection::export($rf);

    }
}
