<?php

namespace AppBundle;

/**
 * Class DataSource
 * @package AppBundle
 */
abstract class DataSource
{
    /**
     * @var Validator[]
     */
    protected $validatorsList = [];

    /**
     * @var Model
     */
    protected $prototype = null;

    /**
     * @return array | null
     */
    abstract protected function next();

    /**
     * @return null
     */
    abstract protected function preProcess();

    /**
     * @return null
     */
    abstract protected function postProcess();

    /**
     * @return Model[]
     */
    public function retrieve()
    {
        $this->preProcess();

        $result = [];

        while ($data = $this->next()) {
            
            if ($this->validate($data)) {
                $result[] = $this->wrap($data);
            }
        }

        $this->postProcess();

        return $result;
    }

    /**
     * @param Validator $validator
     * @param string $field
     */
    public function addValidator(Validator $validator, $field)
    {
        if (!isset($this->validatorsList[$field])) {
            $this->validatorsList[$field] = [];
        }

        $this->validatorsList[$field][] = $validator;
    }

    /**
     * @param array $item
     * @return bool
     */
    public function validate($item)
    {
        $result = true;
        foreach ($this->validatorsList as $column => $validators) {

            if (!$result) {
                break;
            }

            if (isset($item[$column])) {

                while (($validator = current($validators)) && $result) {
                    
                    next($validators);
                    $result = $result && $validator->validate($item[$column]);
                }

            } else {

                $result = false;
            }

        }
        
        return $result;
    }

    /**
     * @param Model $prototype
     */
    public function setPrototype(Model $prototype)
    {
        $this->prototype = $prototype;
    }

    /**
     * @param $data
     * @return Model
     * @throws DataSourceException
     */
    protected function wrap($data)
    {
        if ($this->prototype) {

            $model = clone $this->prototype;
            $model->fromArray($data);

            return $model;
        } else {
            throw new DataSourceException('Prototype object is missed!');
        }
    }
}
