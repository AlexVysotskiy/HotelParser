<?php

namespace AppBundle;

class ReadWriteService
{

    /**
     * @var DataSource
     */
    protected $dataSource = null;

    /**
     * @var OutputFormatter[]
     */
    protected $outputFormatters = [];

    public function process()
    {
        $itemsList = $this->dataSource->retrieve();

        foreach ($this->outputFormatters as $outputFormatter) {

            $outputFormatter->setItems($itemsList);
            $outputFormatter->output();
        }
    }

    /**
     * @param DataSource $dataSource
     */
    public function setDataSource(DataSource $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @param OutputFormatter[] $formatters
     */
    public function setOutputFormatters($formatters)
    {
        foreach ($formatters as $formatter) {
            $this->addOutputFormatter($formatter);
        }
    }

    public function addOutputFormatter(OutputFormatter $formatter)
    {

        $this->outputFormatters[] = $formatter;
    }

}
