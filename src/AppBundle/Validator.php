<?php

namespace AppBundle;

/**
 * Class Validator
 * @package AppBundle
 */
abstract class Validator
{
    /**
     * @param mixed $value
     * @return bool
     */
    abstract public function validate($value);
}
