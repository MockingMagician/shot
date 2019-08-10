<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

/**
 * Class ServiceDefinitionIterator.
 *
 * @method ServiceDefinition current()
 */
class ServiceDefinitionIterator extends \AppendIterator
{
    public function __construct(ServiceDefinition ...$serviceDefinitions)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($serviceDefinitions));
    }

    public function append(\Iterator $iterator): void
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(\sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
    }
}
