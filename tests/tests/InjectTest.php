<?php

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\TestClasses\A;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class InjectTest extends TestCase
{
    public function testInjectionRequireOnce()
    {
        $i = $j = $k = 1000;

        $function = [];

        $toInjectBig = new \SplFileInfo(__DIR__.'/../var/toInjectBig.php');
        $toInjectSmall = new \SplFileInfo(__DIR__.'/../var/toInjectSmall.php');

        $memoryGetUsageStart = memory_get_usage();
        while ($i-- > 0) {
            $function[] = function () {
                $var = require __DIR__.'/../var/toInjectSmall.php';

                return $var;
            };
        }
        $memoryGetUsageEnd = memory_get_usage() - $memoryGetUsageStart;
        $averageA = $memoryGetUsageEnd / $k;

        $memoryGetUsageStart = memory_get_usage();
        while ($j-- > 0) {
            $function[] = function () {
                $var = require __DIR__.'/../var/toInjectBig.php';

                return $var;
            };
        }
        $memoryGetUsageEnd = memory_get_usage() - $memoryGetUsageStart;
        $averageB = $memoryGetUsageEnd / $k;

        $this->assertLessThan($toInjectBig->getSize(), $averageB);

        foreach ($function as $k => $f) {
            $memoryGetUsageStart = memory_get_usage();
            $this->assertInstanceOf(A::class, $function[$k]());
            $memoryGetUsageEnd = memory_get_usage() - $memoryGetUsageStart;
            var_dump(round(memory_get_usage() / 10 ** 6, 2));
        }

    }
}
