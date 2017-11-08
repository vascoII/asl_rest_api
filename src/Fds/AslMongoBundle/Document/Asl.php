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
     * @ODM\ReferenceMany(targetDocument="Property", mappedBy="asl")
     */
    private $properties;
    
    /**
     * @ODM\ReferenceMany(targetDocument="Membershipfee", mappedBy="asl")
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
    
    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setCountry($country) {
        $this->country = $country;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }
    
    public function getProperties() {
        return $this->properties;
    }

    public function getMembershipfees() {
        return $this->membershipfees;
    }

}

