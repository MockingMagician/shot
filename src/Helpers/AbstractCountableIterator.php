<?php

namespace MockingMagician\Shot\Helpers;


use AppendIterator;
use ArrayAccess;
use Countable;

abstract class AbstractCountableIterator extends AppendIterator implements Countable, ArrayAccess
{
    /**
     * @var int storing length for countable
     */
    protected $length = 0;
    protected $k = 0;

    public function __construct(...$objs)
    {
        parent::__construct();
        parent::append(new \ArrayIterator($objs));
        $countObjs = \count($objs);
        $this->length += $countObjs;
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
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return $this->length;
    }

    public function rewind()
    {
        $this->k = 0;
        parent::rewind();
    }

    public function valid()
    {
        return parent::valid();
    }

    public function key()
    {
        return $this->k;
    }

    public function current()
    {
        return parent::current();
    }

    public function next()
    {
        $this->k++;
        parent::next();
    }


    private function offsetMustBePositiveInteger($offset)
    {
        if (!is_int($offset)) {
            throw new \UnexpectedValueException('Offset MUST be an integer value');
        }

        if ($offset < 0) {
            throw new \UnexpectedValueException('Offset MUST be an positive integer');
        }
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        $this->offsetMustBePositiveInteger($offset);

        foreach ($this as $v) {
            $offset--;
            if ($offset < 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        $this->offsetMustBePositiveInteger($offset);

        foreach ($this as $v) {
            $offset--;
            if ($offset < 0) {
                return $v;
            }
        }

        throw new \UnexpectedValueException(sprintf('Offset %s is not defined', $offset));
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException('Can not redefined value by array access');
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        throw new \RuntimeException('Can not redefined value by array access');
    }


}