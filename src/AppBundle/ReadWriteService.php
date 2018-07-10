<?php

namespace AppBundle;

use AppBundle\Interfaces\SortingInterface;
use AppBundle\Interfaces\FilteringInterface;

class ReadWriteService {

    /**
     * @var DataSource
     */
    protected $dataSource = null;

    /**
     * @var OutputFormatter[]
     */
    protected $outputFormatters = [];

    /**
     * @var SortingInterface
     */
    protected $sorter = null;

    /**
     * @var FilteringInterface
     */
    protected $filter = null;

    public function process() {

        $itemsList = $this->dataSource->retrieve();
        
        if ($this->sorter) {
            $this->sorter->sort($itemsList);
        }

        if ($this->filter) {
            $itemsList = $this->filter->filter($itemsList);
        }

        foreach ($this->outputFormatters as $outputFormatter) {

            $outputFormatter->setItems($itemsList);
            $outputFormatter->output();
        }
    }

    /**
     * @param DataSource $dataSource
     */
    public function setDataSource(DataSource $dataSource) {
        $this->dataSource = $dataSource;
    }

    /**
     * @param OutputFormatter[] $formatters
     */
    public function setOutputFormatters($formatters) {
        foreach ($formatters as $formatter) {
            $this->addOutputFormatter($formatter);
        }
    }

    public function addOutputFormatter(OutputFormatter $formatter) {

        $this->outputFormatters[] = $formatter;
    }

    public function setSorter(SortingInterface $sorter) {
        $this->sorter = $sorter;
    }

    public function setFilter(FilteringInterface $filter) {
        $this->filter = $filter;
    }

}
