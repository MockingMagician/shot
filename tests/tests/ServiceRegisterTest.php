<?php

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\Exceptions\ServiceException;
use MockingMagician\Shot\Exceptions\ServiceIdDuplicateException;
use MockingMagician\Shot\Exceptions\ServiceNotDefinedException;
use MockingMagician\Shot\TestClasses\A;
use MockingMagician\Shot\_ServiceRegister;
use MockingMagician\Shot\TestClasses\E;
use PHPUnit\Framework\TestCase;

class ServiceRegisterTest extends TestCase
{

    /**
     * @throws ServiceIdDuplicateException
     * @throws ServiceException
     * @throws ServiceNotDefinedException
     */
    public function testCreateService()
    {
        $serviceRegister = new _ServiceRegister();
        $string = '\@string';
        $integer = random_int(0, 1000);
        $string2 = 'string2';
        $integer2 = random_int(0, 1000);
        $serviceRegister->createService(
            E::class,
            [
                'a' => '@service_class_a',
                'integer' => $integer,
                'string' => $string,
            ]
        );
        $serviceRegister->createService(A::class, [$string2, $integer2], 'service_class_a');
        /** @var E $s */
        $s = $serviceRegister->getService(E::class);
        self::assertInstanceOf(E::class, $s);
        self::assertEquals(substr($string, 1).$string2, $s->getString());
        self::assertEquals($integer + $integer2, $s->getInteger());
    }
}
