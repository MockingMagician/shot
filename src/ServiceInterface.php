<?php

namespace MockingMagician\Shot;


interface ServiceInterface
{
    public function getId(): string;
    public function getDefined();
    public function isSingleton(?bool $bool = null): bool;
}
