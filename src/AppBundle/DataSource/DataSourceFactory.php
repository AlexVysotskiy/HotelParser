<?php

namespace AppBundle\DataSource;

class DataSourceFactory
{
    /**
     * @param $type
     * @return DataSource|null
     */
    public static function getDataSource($type)
    {
        switch ($type) {
            case 'csv': {
                return new CsvFileSource();
            }
        }
    }
}
