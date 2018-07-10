<?php

namespace AppBundle\Interfaces;

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

    /**
     * @return SortingInterface | null
     */
    public function buildSorter();

    /**
     * @return FilteringInterface | null
     */
    public function buildFilter();
}
