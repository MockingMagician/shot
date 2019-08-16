<?php

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\Exceptions\ParameterTypeImplementException;
use MockingMagician\Shot\Parameter;
use MockingMagician\Shot\TestClasses\B;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{

    /**
     * @throws \MockingMagician\Shot\Exceptions\ParameterTypeImplementException
     */
    public function test__construct()
    {
        $p = new Parameter('a');
        self::assertEquals(Parameter::TYPE_STRING, $p->getType());

        $p = new Parameter(1);
        self::assertEquals(Parameter::TYPE_INT, $p->getType());

        $p = new Parameter(0.1);
        self::assertEquals(Parameter::TYPE_FLOAT, $p->getType());

        $p = new Parameter(true);
        self::assertEquals(Parameter::TYPE_BOOLEAN, $p->getType());

        $p = new Parameter(false);
        self::assertEquals(Parameter::TYPE_BOOLEAN, $p->getType());

        $p = new Parameter(null);
        self::assertEquals(Parameter::TYPE_NULL, $p->getType());

        $p = new Parameter(B::class);
        self::assertEquals(Parameter::TYPE_OBJECT, $p->getType());

        $p = new Parameter(\DateTime::class);
        self::assertEquals(Parameter::TYPE_OBJECT, $p->getType());

        $p = new Parameter([]);
        self::assertEquals(Parameter::TYPE_ARRAY, $p->getType());

        $e = null;
        try {
            $p = new Parameter(fopen(__FILE__, 'r'));
        } catch (ParameterTypeImplementException $e) {
        }
        self::assertInstanceOf(ParameterTypeImplementException::class, $e);

    }
}
