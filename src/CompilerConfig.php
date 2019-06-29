<?php

namespace MockingMagician\Shot;


class CompilerConfig implements CompilerConfigInterface
{
    public function __construct()
    {
    }

    public function getNaturals(): ClassIterator
    {
        // TODO: Implement getNaturals() method.
    }

    public function getManualsDefined()
    {

    }

    public static function createFromYaml(string $yamlPath): CompilerConfigInterface
    {
        return new static();
    }
}
