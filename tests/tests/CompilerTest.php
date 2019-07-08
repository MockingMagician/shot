<?php

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\Compiler;
use MockingMagician\Shot\CompilerConfig;
use MockingMagician\Shot\Exceptions\ServiceIdDuplicateException;
use MockingMagician\Shot\Exceptions\ServiceNotDefinedException;
use MockingMagician\Shot\ManualDefined;
use MockingMagician\Shot\ManualDefinedIterator;
use MockingMagician\Shot\TestClasses\A;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class CompilerTest extends TestCase
{
    /**
     * @throws ServiceIdDuplicateException
     * @throws ServiceNotDefinedException
     */
    public function testCompile()
    {
        $manualDefined = new ManualDefined('class-a', A::class, true, ['test']);
        $manualDefinedIterator = new ManualDefinedIterator($manualDefined);
        $config = new CompilerConfig($manualDefinedIterator, null);

        $classA = (new Compiler($config))->compile()->getService('class-a');
        $this->assertInstanceOf(A::class, $classA);
        /** @var $classA A */
        $this->assertEquals('test', $classA->getString());
    }
}
