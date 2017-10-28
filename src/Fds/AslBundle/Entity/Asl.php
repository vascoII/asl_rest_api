<?php

namespace Fds\AslBundle\Entity;

class Asl
{
    public $name;

    public $address;
    
    public $postalCode;
    
    public $city;

    public $country;
    
    public function __construct($name, $address, $postalCode, $city, $country)
    {
        $this->name = $name;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }
}