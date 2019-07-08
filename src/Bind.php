<?php

namespace MockingMagician\Shot;


class Bind
{
    /** @var string */
    private $name;
    private $value;

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
