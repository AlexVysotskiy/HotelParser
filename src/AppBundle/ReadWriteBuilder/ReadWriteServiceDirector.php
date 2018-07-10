<?php

namespace AppBundle\ReadWriteBuilder;

use AppBundle\ReadWriteService;

class ReadWriteServiceDirector
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    public function getService()
    {
        $service = new ReadWriteService();

        $service->setDataSource($this->builder->buildDataSource());
        $service->setOutputFormatters($this->builder->buildOutputFormatters());

        return $service;
    }

    public function setBuilder(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }
}
