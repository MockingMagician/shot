<?php

namespace MockingMagician\Shot;


class Bind
{
    /** @var string */
    private $name;
    private $value;

    public function getName(): string
    {
        return $this->name;
    }

    /** @return mixed */
    public function getValue()
    {
        return $this->value;
    }

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
