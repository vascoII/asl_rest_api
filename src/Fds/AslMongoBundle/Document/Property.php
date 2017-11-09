<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AslMongoBundle\Document\Property
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AslMongoBundle\Repository\PropertyRepository"
 * )
 */
class Property
{
    /**
     * @var MongoId $id
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var integer $identifier
     * @ODM\Field(name="identifier", type="integer")
     */
    protected $identifier;

    /**
     * @var string $number
     * @ODM\Field(name="number", type="string")
     */
    protected $number;

    /**
     * @var string $propertyType
     * @ODM\Field(name="propertyType", type="string")
     */
    protected $propertyType;

    /**
     * @ODM\ReferenceMany(targetDocument="Resident", cascade="all")
     */
    protected $residents;

    /**
     * @ODM\ReferenceMany(targetDocument="Owner", cascade="all")
     */
    protected $owners;

    /** 
     * @ODM\Field(type="date") 
     */
    protected $createdAt;
    
    
    /**
     * Get id
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identifier
     * @param integer $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }
    
    /**
     * Get identifier
     * @return integer $identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
    
    /**
     * Set number
     * @param string $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     * @return string $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set propertyType
     * @param string $propertyType
     * @return $this
     */
    public function setPropertyType($propertyType)
    {
        $this->propertyType = $propertyType;
        return $this;
    }

    /**
     * Get propertyType
     * @return string $propertyType
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     * Set residents
     * @param Resident $resident
     * @return $this
     */
    public function setResidents(Resident $resident)
    {
        array_push($this->residents, $resident);
        return $this;
    }

    /**
     * Get residents
     * @return Resident[]
     */
    public function getResidents()
    {
        return $this->residents;
    }

    /**
     * Set owners
     * @param Owner $owner
     * @return $this
     */
    public function setOwners(Owner $owner)
    {
        array_push($this->owners, $owner);
        return $this;
    }

    /**
     * Get owners
     * @return Owner[]
     */
    public function getOwners()
    {
        return $this->owners;
    }
    
    /**
     * Set createdAt
     * @param date $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    /**
     * Get createAt
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
