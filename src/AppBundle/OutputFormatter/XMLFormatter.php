<?php

namespace AppBundle\OutputFormatter;

use AppBundle\OutputFormatter;

class XMLFormatter extends OutputFormatter
{

    /**
     * @return string
     */
    protected function generateOutput()
    {
        $xml = new \SimpleXMLElement('<items/>');

        foreach ($this->items as $item) {

            $child = $xml->addChild('item');

            foreach ($item->toArray() as $key => $value) {
                $child->addChild($key, $value);
            }
        }

        return $xml->asXML();
    }
}
