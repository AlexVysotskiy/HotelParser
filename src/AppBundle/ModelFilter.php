<?php

namespace AppBundle;

use AppBundle\Interfaces\FilteringInterface;

class ModelFilter implements FilteringInterface {

    const CONDITION_EQUAL = 'eq';
    const CONDITION_NOT_EQUAL = 'neq';
    const CONDITION_LESS = 'lt';
    const CONDITION_LESS_EQ = 'lte';
    const CONDITION_MORE = 'gt';
    const CONDITION_MORE_EQ = 'gte';
    const CONDITION_LIKE = 'like';

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $operation;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $field
     * @param string $order
     */
    public function __construct($field, $operation, $value) {

        $this->field = $field;
        $this->operation = $operation;
        $this->value = $value;
    }

    public function filter($array) {

        $methodName = 'get' . ucfirst($this->field);

        $checkCondition = $this->getChecker();
        $controlValue = $this->value;

        return array_filter($array, function($item) use ($methodName, $checkCondition, $controlValue) {
            return $checkCondition($item->$methodName(), $controlValue);
        });
    }

    /**
     * @return callable
     */
    private function getChecker() {
        switch ($this->operation) {
            case self::CONDITION_EQUAL:
                return function($x, $y) {
                    return $x == $y;
                };
            case self::CONDITION_LESS:
                return function($x, $y) {
                    return $x < $y;
                };
            case self::CONDITION_LESS_EQ:
                return function($x, $y) {
                    return $x <= $y;
                };
            case self::CONDITION_MORE :
                return function($x, $y) {
                    return $x > $y;
                };
            case self::CONDITION_MORE_EQ:
                return function($x, $y) {
                    return $x >= $y;
                };
            case self::CONDITION_NOT_EQUAL:
                return function($x, $y) {
                    return $x != $y;
                };
            case self::CONDITION_LIKE:
                return function($x, $y) {
                    return preg_match('/' . addslashes($y) . '/', $x);
                };
            default :
                return function($x, $y) {
                    return true;
                };
        }
    }

}
