<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot\TestClasses;

class A
{
    /** @var string */
    protected $string;
    /** @var int */
    protected $integer;

    public function __construct(string $string, int $integer)
    {
        $this->string = $string;
        $this->integer = $integer;
    }

    public function getString(): string
    {
        return $this->string;
    }

    public function getInteger(): int
    {
        return $this->integer;
    }

    public function appendToString(string $string)
    {
        $this->string .= $string;
    }

    public function addToInteger(int $integer)
    {
        $this->integer += $integer;
    }
}
