<?php

namespace AppBundle\OutputFormatter;

use AppBundle\OutputFormatter;
use Symfony\Component\Yaml\Yaml;

class YamlFormatter extends OutputFormatter
{

    /**
     * @return string
     */
    protected function generateOutput()
    {
        $result = [];

        foreach ($this->items as $item) {

            $result[$item->getId()] = $item->toArray();
        }

        return Yaml::dump(['items' => $result]);
    }
}
