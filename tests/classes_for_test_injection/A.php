<?php

namespace MockingMagician\Shot\TestClasses;

class A
{
    /** @var string */
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }
}
