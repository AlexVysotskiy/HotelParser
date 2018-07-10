<?php
/**
 * @copyright  Copyright (c) 2018 TraSo GmbH (www.traso.de)
 * @author     a.vysotckii
 * @since      7/10/18
 */


namespace AppBundle;

use AppBundle\OutputFormatter\Destination;


abstract class OutputFormatter
{
    /**
     * @var Model[]
     */
    protected $items = [];

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * @return string
     */
    abstract protected function generateOutput();

    public function output()
    {
        if ($this->destination && $this->items) {
            $this->destination->write($this->generateOutput());
        } else {
            throw new OutputFormatterException('Output formatter is not configured!');
        }
    }

    /**
     * @param Model[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @param Destination $destination
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
    }
}
