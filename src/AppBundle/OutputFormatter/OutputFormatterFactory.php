<?php

namespace AppBundle\OutputFormatter;


use AppBundle\OutputFormatter;

class OutputFormatterFactory
{
    /**
     * @param $type
     * @return OutputFormatter|null
     */
    public static function getOutputFormatter($type)
    {
        switch ($type) {
            case 'json': {
                return new JSONFormatter();
            }
            case 'xml': {
                return new XMLFormatter();
            }
            case 'yaml': {
                return new YamlFormatter();
            }
        }
    }
}
