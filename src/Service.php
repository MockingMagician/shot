<?php

namespace MockingMagician\Shot;


class Service
{
    /** @var string */
    private $id;
    /** @var bool */
    private $singleton;
    /** @var callable|object */
    private $service;

    public function __construct(string $id, bool $singleton, callable $service)
    {
        $this->id = $id;
        $this->singleton = $singleton;
        if ($this->isSingleton()) {
            $this->service = $service();

            return;
        }
        $this->service = $service;
    }

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /** @return bool */
    public function isSingleton(): bool
    {
        return $this->singleton;
    }

    /** @return object */
    public function getService()
    {
        if ($this->isSingleton()) {
            return $this->service;
        }

        return ($this->service)();
    }
}
