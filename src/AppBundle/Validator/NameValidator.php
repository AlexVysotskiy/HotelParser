<?php

namespace AppBundle\Validator;

class NameValidator extends RegexValidator
{
    public function __construct()
    {
        parent::__construct('/^[\x00-\x7F]+$/');
    }

}
