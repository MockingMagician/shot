<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;
use MockingMagician\Shot\Helpers\AbstractCountableIterator;

/**
 * @method Parameter current()
 */
class ParameterIterator extends AbstractCountableIterator
{
    public function __construct(Parameter... $parameters)
    {
        parent::__construct(...$parameters);
    }

    public function add(Parameter $parameter): self
    {
        $this->append(new static($parameter));

        return $this;
    }
}
