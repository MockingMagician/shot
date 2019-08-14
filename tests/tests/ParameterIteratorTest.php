<?php

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\Parameter;
use MockingMagician\Shot\ParameterIterator;
use PHPUnit\Framework\TestCase;

class ParameterIteratorTest extends TestCase
{
    /** @var \Generator */
    protected $parameterGenerator;

    public function setUp(): void
    {
    }

    protected function getParameterGenerator(): \Generator
    {
        $i = 0;
        while (true) {
            yield [
                new Parameter($i, 'int'),
                new Parameter((float) "$i.$i", 'float'),
                new Parameter((string) $i, 'string'),
            ];
            $i++;
        }
    }

    protected function getParameter(): array
    {
        if (null === $this->parameterGenerator) {
            $this->parameterGenerator = $this->getParameterGenerator();
        } else {
            $this->parameterGenerator->next();
        }

        return $this->parameterGenerator->current();
    }

    public function test count()
    {
        $pi = new ParameterIterator(...$this->getParameter());
        $this->assertEquals(3, \count($pi));
        $pi->add(new Parameter(new \DateTime(), \DateTime::class));
        $this->assertEquals(4, \count($pi));
        $pi->append(new ParameterIterator(... $this->getParameter()));
        $this->assertEquals(7, \count($pi));
        $pi->add(new Parameter(new \DateTime(), \DateTime::class));
        $this->assertEquals(8, \count($pi));
    }

    public function test foreach()
    {
        $pi = new ParameterIterator(...$this->getParameter(), ...$this->getParameter(), ...$this->getParameter());
        $k = -1;
        foreach ($pi as $k => $i) {
            static::assertInstanceOf(Parameter::class, $i);
        }
        static::assertEquals(8, $k);
        static::assertEquals(9, \count($pi));

        $pi2 = new ParameterIterator(...$this->getParameter(), ...$this->getParameter());
        $pi->append($pi2);
        $k = -1;
        foreach ($pi as $k => $i) {
            static::assertInstanceOf(Parameter::class, $i);
        }
        static::assertEquals(14, $k);
        static::assertEquals(15, \count($pi));
    }

    public function test array access()
    {
        $pi = new ParameterIterator(...$this->getParameter(), ...$this->getParameter(), ...$this->getParameter());
        for ($i = 0; $i < $pi->count(); $i++) {
            self::assertInstanceOf(Parameter::class, $pi[$i]);
        }

        self::assertTrue(isset($pi[0], $pi[1], $pi[2], $pi[3], $pi[4], $pi[5], $pi[6], $pi[7], $pi[8]));
        self::assertFalse(isset($pi[9]));
    }
}
