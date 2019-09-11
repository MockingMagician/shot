<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 09/09/19
 * Time: 14:32
 */

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\TestClasses\A;
use MockingMagician\Shot\Service;
use MockingMagician\Shot\ServiceRegisterInterface;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    private $serviceRegister;

    public function setUp(): void
    {
        parent::setUp();
        $this->serviceRegister = $this->prophesize(ServiceRegisterInterface::class)->reveal();
    }

    /**
     * @throws \MockingMagician\Shot\Exceptions\ServiceException
     */
    public function testGetService()
    {
        $string = 'this is my string';
        $integer = random_int(0, 5000);
        $service = new Service(
            $this->serviceRegister,
            A::class,
            A::class,
            [$string, $integer]
        );
        /** @var A $s */
        $s = $service->getService();
        self::assertInstanceOf(A::class, $s);
        self::assertEquals($string, $s->getString());
        self::assertEquals($integer, $s->getInteger());
        $s2 = $service->getService();
        self::assertSame($s, $s2);
        $service->isSingleton(false);
        $s3 = $service->getService();
        self::assertNotSame($s, $s3);
        $toAppend = ' with a little bit more';
        $toAdd = random_int(0, 5000);
        $service = new Service(
            $this->serviceRegister,
            A::class,
            A::class,
            [$string, $integer],
            [
                ['appendToString', [$toAppend]],
                ['addToInteger', [$toAdd]],
            ]
        );
        /** @var A $s */
        $s = $service->getService();
        self::assertInstanceOf(A::class, $s);
        self::assertEquals($string.$toAppend, $s->getString());
        self::assertEquals($integer + $toAdd, $s->getInteger());
    }
}
