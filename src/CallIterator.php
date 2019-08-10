<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

/**
 * Class CallIterator.
 *
 * @method Call current()
 */
class CallIterator extends \AppendIterator implements \Countable
{
    private $length = 0;

    public function __construct(Call ...$calls)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($calls));
        $this->length += \count($calls);
    }

    public function append(\Iterator $iterator): void
    {
        if (!$iterator instanceof static) {
            throw new \UnexpectedValueException(\sprintf('Expect %s', static::class));
        }

        parent::append($iterator);
        $this->length += $iterator->length;
    }

    /**
     * Count elements of an object.
     *
     * @see http://php.net/manual/en/countable.count.php
     *
     * @return int The custom count as an integer.
     *
     * The return value is cast to an integer.
     *
     * @since 5.1.0
     */
    public function count()
    {
        return $this->length;
    }
}
