<?php

namespace MockingMagician\Shot\TestClasses;


class E extends A
{
    public function __construct(string $string, int $integer, A $a)
    {
        parent::__construct($string, $integer);
        $this->string .= $a->getString();
        $this->integer += $a->getInteger();
    }
}
