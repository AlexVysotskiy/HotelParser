<?php

namespace AppBundle\ReadWriteBuilder;

use AppBundle\DataSource;
use AppBundle\Model;
use AppBundle\OutputFormatter;

interface BuilderInterface
{
    /**
     * @return DataSource
     */
    public function buildDataSource();

    /**
     * @return OutputFormatter[]
     */
    public function buildOutputFormatters();

    /**
     * @return Model
     */
    public function buildPrototype();
}
