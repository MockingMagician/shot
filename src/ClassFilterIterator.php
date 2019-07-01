<?php

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
        return (bool) preg_match(static::CLASS_MATCH, $this->current()->getFilename());
    }
}
