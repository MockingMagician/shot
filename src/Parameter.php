<?php

namespace MockingMagician\Shot;


use MockingMagician\Shot\Exceptions\ParameterTypeImplementException;

class Parameter
{
    public const TYPE_BOOLEAN = 'bool';
    public const TYPE_OBJECT = 'object';
    public const TYPE_INT = 'int';
    public const TYPE_FLOAT = 'float';
    public const TYPE_NULL = 'null';
    public const TYPE_STRING = 'string';
    public const TYPE_ARRAY = 'array';
    public const TYPE_SERVICE_DEFINITION = 'service_definition';

    private $value;
    private $type;

    /**
     * Parameter constructor.
     * @param $value
     * @throws ParameterTypeImplementException
     */
    public function __construct($value)
    {
        $this->value = $value;
        $this->typeDefiner($value);
    }

    /**
     * @param $value
     * @throws ParameterTypeImplementException
     */
    private function typeDefiner($value)
    {
        if (is_string($value) && class_exists($value)) {
            $this->type = static::TYPE_OBJECT;

            return;
        }

        if (is_string($value) && 0 === mb_strpos($value, '@')) {
            $this->type = static::TYPE_SERVICE_DEFINITION;

            return;
        }

        if (is_bool($value)) {
            $this->type = static::TYPE_BOOLEAN;

            return;
        }

        if (is_int($value)) {
            $this->type = static::TYPE_INT;

            return;
        }

        if (is_float($value)) {
            $this->type = static::TYPE_FLOAT;

            return;
        }

        if (is_null($value)) {
            $this->type = static::TYPE_NULL;

            return;
        }

        if (is_array($value)) {
            $this->type = static::TYPE_ARRAY;

            return;
        }

        if (is_string($value)) {
            $this->type = static::TYPE_STRING;

            return;
        }

        throw new ParameterTypeImplementException($value);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function __toString()
    {
        return "($this->type) $this->value";
    }

    public static function isString(Parameter $parameter): bool
    {
        return static::TYPE_STRING === $parameter->getType();
    }

    public static function isArray(Parameter $parameter): bool
    {
        return static::TYPE_ARRAY === $parameter->getType();
    }

    public static function isObject(Parameter $parameter): bool
    {
        return static::TYPE_OBJECT === $parameter->getType();
    }

    public static function isNull(Parameter $parameter): bool
    {
        return static::TYPE_NULL === $parameter->getType();
    }

    public static function isBoolean(Parameter $parameter): bool
    {
        return static::TYPE_BOOLEAN === $parameter->getType();
    }

    public static function isFloat(Parameter $parameter): bool
    {
        return static::TYPE_FLOAT === $parameter->getType();
    }

    public static function isInt(Parameter $parameter): bool
    {
        return static::TYPE_INT === $parameter->getType();
    }

    public static function isService(Parameter $parameter): bool
    {
        return static::TYPE_SERVICE_DEFINITION === $parameter->getType();
    }
}
