<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\Tests;

use MockingMagician\Shot\Bind;
use MockingMagician\Shot\BindIterator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class BindIteratorTest extends TestCase
{
    public function test iterator(): void
    {
        $bindIterator = new BindIterator();
        $i = 0;
        foreach ($bindIterator as $bind) {
            ++$i;
        }
        static::assertEquals(0, $i);

        $bindIterator = new BindIterator(new Bind('a', 5), new Bind('b', 'azerty'));
        $i = 0;
        foreach ($bindIterator as $bind) {
            ++$i;
            /** @var Bind $bind */
            static::assertContains($bind->getName(), ['a', 'b']);
            static::assertContains($bind->getValue(), [5, 'azerty']);
        }
        static::assertEquals(2, $i);
    }
}
