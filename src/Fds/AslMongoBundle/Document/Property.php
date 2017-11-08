<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ODM\Document
 */
class Property
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $number;

    /**
     * @ODM\Field(type="string")
     */
    private $propertyType;

    /**
     * @ODM\ReferenceMany(targetDocument="Resident", mappedBy="property")
     */
    private $residents;
    
    /**
     * @ODM\ReferenceMany(targetDocument="Owner", mappedBy="property")
     */
    private $owners;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->residents = new ArrayCollection();
        $this->owners = new ArrayCollection();
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setNumber($number) {
        $this->number = $number;
    }
    
    public function setPropertyType($propertyType) {
        $this->propertyType = $propertyType;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getPropertyType() {
        return $this->propertyType;
    }

    public function getResidents() {
        return $this->residents;
    }
    
    public function getOwners() {
        return $this->owners;
    }


}

