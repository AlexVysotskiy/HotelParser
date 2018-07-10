<?php

namespace Tests\AppBundle;

use PHPUnit\Framework\TestCase;

class JsonFormatterTest extends TestCase {

    public function testFormatter() {

        $items = [
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
        ];

        foreach ($items as $num => $item) {
            $item->setName($num);
            $item->setStars(5);
        }

        $class = new \ReflectionClass('\AppBundle\OutputFormatter\JSONFormatter');
        $method = $class->getMethod('generateOutput');
        $method->setAccessible(true);
        
        $formatter = new \AppBundle\OutputFormatter\JSONFormatter();
        $formatter->setItems($items);
        
        $result = $method->invoke($formatter);
        $this->assertNotEmpty(json_decode($result, true));
        $this->assertArrayHasKey('items', json_decode($result, true));
    }

}
