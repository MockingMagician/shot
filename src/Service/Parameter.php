<?php

namespace MockingMagician\Shot\Service;


use MockingMagician\Shot\Exceptions\ServiceException;

class Parameter
{
    private $value;

    /**
     * Parameter constructor.
     * @param $value
     * @throws ServiceException
     */
    public function __construct($value)
    {
        if (!(
            is_int($value)
            || is_string($value)
            || is_bool($value)
            || is_float($value)
            || $value instanceof Parameters
        )) {
            throw new ServiceException('Parameter value have to be string or int or float or boolean');
        }

        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
