<?php

namespace AppBundle\Interfaces;

interface FilteringInterface {

    /**
     * @param array $array
     * @return array
     */
    public function filter($array);
}
