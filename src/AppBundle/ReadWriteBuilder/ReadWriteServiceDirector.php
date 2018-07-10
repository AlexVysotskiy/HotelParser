<?php

namespace AppBundle\ReadWriteBuilder;

use AppBundle\ReadWriteService;
use AppBundle\Interfaces\BuilderInterface;

class ReadWriteServiceDirector {

    /**
     * @var BuilderInterface
     */
    private $builder;

    public function getService() {
        
        $service = new ReadWriteService();

        $service->setDataSource($this->builder->buildDataSource());
        $service->setOutputFormatters($this->builder->buildOutputFormatters());

        if ($sorter = $this->builder->buildSorter()) {
            $service->setSorter($sorter);
        }
        
        if ($filter = $this->builder->buildFilter()) {
            $service->setFilter($filter);
        }

        return $service;
    }

    public function setBuilder(BuilderInterface $builder) {
        $this->builder = $builder;
    }

}
