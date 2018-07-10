<?php
/**
 * @copyright  Copyright (c) 2018 TraSo GmbH (www.traso.de)
 * @author     a.vysotckii
 * @since      7/10/18
 */


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
