<?php

namespace AppBundle\DataSource;

use AppBundle\DataSource;
use AppBundle\Exceptions\DataSourceException;

/**
 * Class CsvFileSource
 */
class CsvFileSource extends DataSource
{

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var resource
     */
    private $resource = null;

    /**
     * @var array
     */
    private $fields = [];

    /**
     * @param string $filePath
     * @throws DataSourceException
     */
    public function setFilePath($filePath)
    {
        if (is_readable($filePath) && is_file($filePath)) {
            $this->filePath = $filePath;
        } else {
            throw new DataSourceException('Provided CSV file is not readable!');
        }
    }

    /**
     * @return array | null
     */
    protected function next()
    {
        if (($data = fgetcsv($this->resource)) !== false) {

            return array_combine($this->fields, $data);
        }
    }

    protected function preProcess()
    {
        if (!$this->filePath || !($this->resource = fopen($this->filePath, 'r'))) {
            throw new DataSourceException('Provided CSV file is not readable!');
        }

        $this->fields = fgetcsv($this->resource);
    }

    protected function postProcess()
    {
        if ($this->resource) {
            fclose($this->resource);
        }
    }
}
