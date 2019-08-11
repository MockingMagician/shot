<?php

namespace MockingMagician\Shot;


class Parameter
{
    private $value;
    private $type;

    public function __construct($value, string $type)
    {
        $this->value = $value;
        $this->type = $type;
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
        if (method_exists($this->value, '__toString')) {
            $value = (string) $this->value;
        } else if (is_object($this->value)) {
            $value = get_class($this->value);
        } else {
            $value = gettype($this->value);
            if (in_array($value, ['integer', 'double', 'string',])) {
                $value = (string) $this->value;
            } else if ("boolean" === $value) {
                if ($this->value) {
                    $value = '/* TRUE */';
                } else {
                    $value = '/* FALSE */';
                }
            } else if ("NULL" === $value) {
                $value = '/* NULL */';
            }
        }

        return "($this->type) $value";
    }
}
