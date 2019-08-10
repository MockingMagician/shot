<?php

namespace MockingMagician\Shot\TestClasses;


class B
{
    /**
     * @var int
     */
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function addOne(): self
    {
        ++$this->number;

        return $this;
    }

    public function multiplyBy(int $number): self
    {
        $this->number *= $number;

        return $this;
    }
}
