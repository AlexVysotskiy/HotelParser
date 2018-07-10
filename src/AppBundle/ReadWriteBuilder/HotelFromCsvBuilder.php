<?php

namespace AppBundle\ReadWriteBuilder;

use AppBundle\DataSource\CsvFileSource;
use AppBundle\DataSource\DataSourceFactory;
use AppBundle\Model\Hotel;
use AppBundle\OutputFormatter;
use AppBundle\OutputFormatter\OutputFormatterFactory;
use AppBundle\Validator\IntegerRangeValidator;
use AppBundle\Validator\NameValidator;
use AppBundle\Validator\UriValidator;
use AppBundle\Interfaces\BuilderInterface;

class HotelFromCsvBuilder implements BuilderInterface {

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var array
     */
    private $outputFormatters = [];

    /**
     * @var array 
     */
    private $sorting = [];

    /**
     * @var array 
     */
    private $filtering = [];

    /**
     * @param string $filePath
     * @param array $outputFormatters
     */
    public function __construct($filePath, $outputFormatters, $sorting = [], $filtering = []) {

        $this->filePath = $filePath;
        $this->outputFormatters = is_array($outputFormatters) ? $outputFormatters : [$outputFormatters];
        $this->sorting = $sorting;
        $this->filtering = $filtering;
    }

    /**
     * @return DataSource
     */
    public function buildDataSource() {

        /* @var CsvFileSource $dataSource */
        $dataSource = DataSourceFactory::getDataSource('csv');

        $dataSource->setFilePath($this->filePath);
        $dataSource->setPrototype($this->buildPrototype());

        $dataSource->addValidator(new NameValidator(), 'name');
        $dataSource->addValidator(new UriValidator(), 'uri');
        $dataSource->addValidator(new IntegerRangeValidator(0, 5), 'stars');

        return $dataSource;
    }

    /**
     * @return OutputFormatter[]
     */
    public function buildOutputFormatters() {

        $list = [];

        $destinationFolder = pathinfo($this->filePath);

        foreach ($this->outputFormatters as $type) {

            /* @var OutputFormatter $formatter */
            if ($formatter = OutputFormatterFactory::getOutputFormatter($type)) {

                $formatter->setDestination(new OutputFormatter\Destination($destinationFolder['dirname'] . DIRECTORY_SEPARATOR . $destinationFolder['filename'] . '.' . $type));
                $list[$type] = $formatter;
            }
        }

        return $list;
    }

    /**
     * @return Model
     */
    public function buildPrototype() {
        return new Hotel();
    }

    /**
     * @return \AppBundle\Interfaces\SortingInterface | null
     */
    public function buildSorter() {

        if ($this->sorting) {
            list($field, $order) = $this->sorting;
            return new \AppBundle\ModelSorter($field, $order);
        }
    }

    public function buildFilter() {

        if ($this->filtering) {
            list($field, $operation, $value) = $this->filtering;
            return new \AppBundle\ModelFilter($field, $operation, $value);
        }
    }

}
