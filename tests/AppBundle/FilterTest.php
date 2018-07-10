<?php

namespace Tests\AppBundle;

use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase {

    public function testFilter() {

        $filter = new \AppBundle\ModelFilter('stars', 'eq', 5);

        $items = [
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
            new \AppBundle\Model\Hotel(),
        ];

        foreach ($items as $num => $item) {
            $item->setStars(5);
        }

        $this->assertCount(count($items), $filter->filter($items));

        $filter = new \AppBundle\ModelFilter('stars', 'lt', 5);
        $this->assertCount(0, $filter->filter($items));
    }

}
