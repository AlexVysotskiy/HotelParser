<?php
/**
 * @copyright  Copyright (c) 2018 TraSo GmbH (www.traso.de)
 * @author     a.vysotckii
 * @since      7/10/18
 */


namespace AppBundle\OutputFormatter;

class Destination
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param $string
     * @return bool
     */
    public function write($string)
    {
        if (!empty($this->filename)) {

            if ($resource = fopen($this->filename, 'w')) {

                fwrite($resource, $string);
                fclose($resource);

                return false;
            }
        }

        return false;
    }
}
