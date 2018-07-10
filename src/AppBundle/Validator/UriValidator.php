<?php

namespace AppBundle\Validator;

class UriValidator extends RegexValidator
{
    public function __construct()
    {
        parent::__construct('/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&\'\(\)\*\+,;=.]+$/i');
    }

}
