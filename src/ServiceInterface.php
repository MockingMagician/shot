<?php

namespace MockingMagician\Shot;


interface ServiceInterface
{
    public function getId(): string;
    public function getService();
    public function isSingleton(?bool $bool = null): bool;
}
