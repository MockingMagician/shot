<?php

namespace MockingMagician\Shot\TestClasses;


class C
{
    public function __construct(
        String $string,
        \DateTime $dateTime,
        B $BClassesTest,
        int $integerWithDefaultValue = 5,
        ?float $floatThatCanBeNull,
        $mixed
    ) {

    }
}
