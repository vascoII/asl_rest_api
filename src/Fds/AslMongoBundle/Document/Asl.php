<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ODM\Document(collection="asl")
 */
class Asl
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @ODM\Field(type="string")
     */
    private $address;

    /**
     * @ODM\Field(type="string")
     */
    private $postalCode;

    /**
     * @ODM\Field(type="string")
     */
    private $city;

    /**
     * @ODM\Field(type="string")
     */
    private $country;
    
    /**
     * @ODM\EmbedMany(targetDocument="Property")
     */
    private $properties;
    
    /**
     * @ODM\EmbedMany(targetDocument="Membershipfee")
     */
    private $membershipfees;
    
    
    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->membershipfees = new ArrayCollection();
    }
          
    public function setId($id)
    {
        $this->id = $id;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setCountry($country) {
        $this->country = $country;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAddress() {
        return $this->address;
    }

    function getPostalCode() {
        return $this->postalCode;
    }

    function getCity() {
        return $this->city;
    }

    function getCountry() {
        return $this->country;
    }
    
    function getProperties() {
        return $this->properties;
    }

    function getMembershipfees() {
        return $this->membershipfees;
    }

}

