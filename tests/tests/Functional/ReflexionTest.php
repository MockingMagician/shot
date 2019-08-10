<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\Tests\Functional;

use MockingMagician\Shot\TestClasses\A;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ReflexionTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function test reflection closure(): void
    {
        $rf = new \ReflectionFunction(function (): \stdClass {
            $gaston = new \stdClass();
            $gaston->whosTheBoss = 'gaston';

            return $gaston;
        });

        $rc = new \ReflectionClass(A::class);
        \var_dump($rc->getName());
        \var_dump($rc->getConstants());
        \var_dump($rc->getConstructor());
        \var_dump($rc->getConstructor()->getName());
        \var_dump($rc->getConstructor()->getExtensionName());
        \var_dump($rc->getConstructor()->getParameters()[0]->getType()->getName());
        \var_dump(\Reflection::getModifierNames($rc->getConstructor()->getModifiers()));
        \var_dump($rc->getDefaultProperties());
        \var_dump($rc->getExtension());
        \var_dump($rc->getExtensionName());
    }
}
