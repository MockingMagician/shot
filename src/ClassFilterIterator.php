<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

class ClassFilterIterator extends \RecursiveFilterIterator
{
    private const CLASS_MATCH = '#[A-Z].*\.php$#';

    /**
     * Check whether the current element of the iterator is acceptable.
     *
     * @see http://php.net/manual/en/filteriterator.accept.php
     *
     * @return bool true if the current element is acceptable, otherwise false
     *
     * @since 5.1.0
     */
    public function accept()
    {
        return (bool) \preg_match(static::CLASS_MATCH, $this->current()->getFilename());
    }
}
