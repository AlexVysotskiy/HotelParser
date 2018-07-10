<?php

namespace AppBundle;

abstract class Model
{
    /**
     * @return mixed
     */
    abstract public function getId();

    /**
     * @param $params
     */
    abstract public function fromArray($params);

    /**
     * @return array
     */
    abstract public function toArray();

}
