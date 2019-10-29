<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 10/08/19
 * Time: 12:11
 */

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\BindIterator;
use MockingMagician\Shot\Call;
use MockingMagician\Shot\CallIterator;
use MockingMagician\Shot\ServiceCompiler;
use MockingMagician\Shot\ServiceDefinition;
use MockingMagician\Shot\_ServiceRegister;
use MockingMagician\Shot\TestClasses\B;
use PHPUnit\Framework\TestCase;

class ServiceCompilerTest extends TestCase
{

    public function testCompile()
    {
        $serviceRegister = new _ServiceRegister();
        $bindIterator = new BindIterator();
        $callIterator = new CallIterator(...[
            new Call('__construct', 5),
            new Call('addOne'),
            new Call('multiplyBy', 3),
        ]);
        $serviceDefinition = new ServiceDefinition('compile-test', B::class, true, $callIterator);
        $serviceCompiler = new ServiceCompiler($serviceDefinition, $serviceRegister, $bindIterator);
        var_dump($serviceCompiler->compile());
    }
}
