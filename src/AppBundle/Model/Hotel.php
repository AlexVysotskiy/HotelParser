<?php

namespace AppBundle\Model;

use AppBundle\Model;

class Hotel extends Model
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $stars;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $uri;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return int
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     * @return self
     */
    public function setStars($stars)
    {
        $this->stars = (int)$stars;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return self
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param $params
     */
    public function fromArray($params)
    {
        $this->setName($params['name']);
        $this->setAddress($params['address']);
        $this->setStars($params['stars']);
        $this->setPhone($params['phone']);
        $this->setUri($params['uri']);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'address' => $this->getAddress(),
            'stars' => $this->getStars(),
            'phone' => $this->getPhone(),
            'uri' => $this->getUri()
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getName();
    }
}
