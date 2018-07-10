<?php

namespace AppBundle\Validator;

use AppBundle\Validator;

class RegexValidator extends Validator {

    /**
     * @var string
     */
    protected $regex;

    public function __construct($regex) {
        $this->regex = $regex;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value) {
        return preg_match($this->regex, $value);
    }

}
