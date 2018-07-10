<?php

namespace AppBundle;

use AppBundle\Interfaces\SortingInterface;

class ModelSorter implements SortingInterface {

    const ORDER_DESC = 'DESC';
    const ORDER_ASC = 'ASC';

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $order;

    /**
     * @param string $field
     * @param string $order
     */
    public function __construct($field, $order) {
        
        $this->field = $field;
        $this->order = in_array($order, [self::ORDER_ASC, self::ORDER_DESC]) ? $order : self::ORDER_ASC;
    }

    /**
     * @param Model[] $array
     */
    public function sort(&$array) {
        
        $methodName = 'get' . ucfirst($this->field);
        $order = $this->order == self::ORDER_ASC ? 1 : -1;

        usort($array, function($a, $b) use ($methodName, $order) {
            
            $valA = $a->$methodName();
            $valB = $b->$methodName();
            
            if ($valA == $valB) {
                return 0;
            }
            
            return ($valA < $valB) ? -$order : $order;
        });
    }

}
