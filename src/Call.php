<?php

namespace MockingMagician\Shot;


class Call
{
    private $method;
    private $arguments;

    public function __construct(string $method, ...$arguments)
    {
        $this->method = $method;
        $this->arguments = $arguments;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
