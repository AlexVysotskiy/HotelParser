<?php

namespace AppBundle\Validator;

use AppBundle\Validator;

class IntegerRangeValidator extends Validator
{

    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value)
    {
        $value = (int)$value;

        return $this->min <= $value && $this->max >= $value;
    }
}
