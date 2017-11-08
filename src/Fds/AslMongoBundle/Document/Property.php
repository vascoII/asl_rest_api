<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document(collection="property")
 */
class Property
{
    /**
     * @Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $number;

    /**
     * @MongoDB\Field(type="string")
     */
    private $propertyType;

    /**
     * @EmbedMany(targetDocument="Owner")
     */
    private $residents;
    
    /**
     * @EmbedMany(targetDocument="Owner")
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

