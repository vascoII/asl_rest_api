<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AslMongoBundle\Document\Resident
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AslMongoBundle\Repository\ResidentRepository"
 * )
 */
class Resident
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
     * @var string $firstName
     * @ODM\Field(name="firstName", type="string")
     */
    protected $firstName;

    /**
     * @var string $lastName
     * @ODM\Field(name="lastName", type="string")
     */
    protected $lastName;

    /**
     * @var string $email
     * @ODM\Field(name="email", type="string")
     */
    protected $email;

    /**
     * @ODM\ReferenceOne(targetDocument="Asl")
     */
    protected $asl;
    
    /**
     * @ODM\ReferenceOne(targetDocument="Property")
     */
    protected $property;
    
    /** 
     * @var date createdAt
     * @ODM\Field(type="date") 
     */
    protected $createdAt;
    
    /** 
     * @var date startAt
     * @ODM\Field(type="date") 
     */
    protected $startAt;
    
    /** 
     * @var date endAt
     * @ODM\Field(type="date") 
     */
    protected $endAt;
    
    
    public function __construct() 
    {
        $this->startAt = new \DateTime();
        $this->createdAt = new \DateTime();
    }
    
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
     * Set firstName
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set asl
     * @param Asl $asl
     * @return $this
     */
    public function setAsl($asl)
    {
        $this->asl = $asl;
        return $this;
    }

    /**
     * Get asl
     * @return Asl $asl
     */
    public function getAsl()
    {
        return $this->asl;
    }
    
    /**
     * Set property
     * @param Property $property
     * @return $this
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Get property
     * @return Property $property
     */
    public function getProperty()
    {
        return $this->property;
    }
    
    /**
     * Get createAt
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Set startAt
     * @param date $startAt
     * @return $this
     */
    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;
        return $this;
    }
    
    /**
     * Get startAt
     * @return date $startAt
     */
    public function getStartAt()
    {
        return $this->startAt;
    }
    
    /**
     * Set endAt
     * @param date $endAt
     * @return $this
     */
    public function setEndAt(\DateTime $endAt)
    {
        $this->endAt = $endAt;
        return $this;
    }
    
    /**
     * Get endAt
     * @return date $endAt
     */
    public function getEndAt()
    {
        return $this->endAt;
    }
}
