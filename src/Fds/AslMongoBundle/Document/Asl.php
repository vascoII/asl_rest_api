<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AslMongoBundle\Document\Asl
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AslMongoBundle\Repository\AslRepository"
 * )
 */
class Asl
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
     * @var string $name
     * @ODM\Field(name="name", type="string")
     */
    protected $name;

    /**
     * @var string $address
     * @ODM\Field(name="address", type="string")
     */
    protected $address;

    /**
     * @var string $postalCode
     * @ODM\Field(name="postalCode", type="string")
     */
    protected $postalCode;

    /**
     * @var string $city
     * @ODM\Field(name="city", type="string")
     */
    protected $city;

    /**
     * @ODM\ReferenceMany(targetDocument="Property", cascade="all")
     */
    protected $properties = array();

    /**
     * @ODM\ReferenceMany(targetDocument="Membershipfee", cascade="all")
     */
    protected $membershipfees = array();

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
     * Set name
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Get postalCode
     * @return string $postalCode
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set properties
     * @param Property $property
     * @return $this
     */
    public function setProperties(Property $property)
    {
        array_push($this->properties, $property);
        return $this;
    }

    /**
     * Get properties
     * @return Property[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set membershipfees
     * @param Membershipfee $membershipfee
     * @return $this
     */
    public function setMembershipfees(Membershipfee $membershipfee)
    {
        array_push($this->membershipfees, $membershipfee);
        return $this;
    }

    /**
     * Get membershipfees
     * @return Membershipfee[]
     */
    public function getMembershipfees()
    {
        return $this->membershipfees;
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
