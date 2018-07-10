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

class HotelFromCsvBuilder implements BuilderInterface
{

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var array
     */
    private $outputFormatters = [];

    /**
     * @param string $filePath
     * @param array $outputFormatters
     */
    public function __construct($filePath, $outputFormatters)
    {
        $this->filePath = $filePath;

        if ($outputFormatters) {
            $this->outputFormatters = is_array($outputFormatters) ? $outputFormatters : [$outputFormatters];
        } else {
            throw new BuilderException('Required params are missed!');
        }

    }

    /**
     * @return DataSource
     */
    public function buildDataSource()
    {
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
    public function buildOutputFormatters()
    {
        $list = [];

        $destinationFolder = pathinfo($this->filePath);

        foreach ($this->outputFormatters as $type) {

            /* @var OutputFormatter $formatter */
            $formatter = OutputFormatterFactory::getOutputFormatter($type);
            $formatter->setDestination(new OutputFormatter\Destination($destinationFolder['dirname'] . DIRECTORY_SEPARATOR . $destinationFolder['filename'] . '.' . $type));

            $list[$type] = $formatter;
        }

        return $list;
    }

    /**
     * @return Model
     */
    public function buildPrototype()
    {
        return new Hotel();
    }
}
