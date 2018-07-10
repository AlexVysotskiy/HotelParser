<?php

namespace Tests\AppBundle;

use PHPUnit\Framework\TestCase;

class SorterTest extends TestCase {

    public function testSorter() {

        $sorter = new \AppBundle\ModelSorter('stars', 'DESC');

        $items = [
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
        ];

        foreach ($items as $num => $item) {
            $item->setStars($num + 1);
        }

        $sorter->sort($items);

        $this->assertEquals(array_reverse(range(1, count($items))), array_map(function($item) {
                    return $item->getStars();
                }, $items));
    }

}
