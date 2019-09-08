<?php

namespace MockingMagician\Shot\TestClasses;


class D
{
    private static $i = 0;

    public static function isStatic()
    {
        echo self::$i;
        self::$i++;
    }
}
