<?php

namespace MockingMagician\Shot;


interface CompilerConfigInterface
{
    public function getNaturals(): ClassIterator;
    public function getManualsDefined();
    public static function createFromYaml(string $yamlPath): CompilerConfigInterface;
}
