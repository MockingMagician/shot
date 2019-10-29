<?php

namespace MockingMagician\Shot\Service;


use MockingMagician\Shot\Exceptions\ServiceException;

class TypeHintedParameter extends Parameter
{
    private $typeHint;

    /**
     * Parameter constructor.
     * @param $value
     * @param string $typeHint
     * @throws ServiceException
     */
    public function __construct($value, string $typeHint)
    {
        parent::__construct($value);
        $this->typeHint = $typeHint;
    }

    public function getTypeHint(): string
    {
        return $this->typeHint;
    }
}
