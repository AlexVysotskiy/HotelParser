<?php

namespace AppBundle\OutputFormatter;

use AppBundle\OutputFormatter;

class JSONFormatter extends OutputFormatter
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

        return json_encode(['items' => $result]);
    }
}
