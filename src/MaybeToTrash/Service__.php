<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

class Service__
{
    private $id;
    private $singleton;
    /** @var callable|mixed */
    private $service;
    private $serviceRegister;

    public function __construct(string $id, bool $singleton, callable $service, ServiceRegister $serviceRegister)
    {
        $this->id = $id;
        $this->singleton = $singleton;
        $this->serviceRegister = $serviceRegister;
        if ($this->isSingleton()) {
            $this->service = $service($this->serviceRegister);

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

        return ($this->service)($this->serviceRegister);
    }
}
