<?php

namespace MockingMagician\Shot\Service;


class Parameters
{
    /**
     * @var Parameter|TypeHintedParameter
     */
    private $parameters = [];

    /**
     * @param Parameter $parameter
     * @param $positionOrName
     * @param string|null $typeHint
     * @throws \MockingMagician\Shot\Exceptions\ServiceException
     */
    public function addParameter(Parameter $parameter, $positionOrName, string $typeHint = null)
    {
        $this->parameters[$positionOrName] = is_null($typeHint)
            ? new Parameter($parameter->getValue())
            : new TypeHintedParameter($parameter->getValue(), $typeHint)
        ;
    }

    /**
     * @return Parameter|TypeHintedParameter
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
