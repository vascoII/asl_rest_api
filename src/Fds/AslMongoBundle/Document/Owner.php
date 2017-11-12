<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AslMongoBundle\Document\Owner
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AslMongoBundle\Repository\OwnerRepository"
 * )
 */
class Owner
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
     * @var string $phone
     * @ODM\Field(name="phone", type="string")
     */
    protected $phone;

    /**
     * @var boolean $propertyAsAddress
     * @ODM\Field(name="propertyAsAddress", type="boolean")
     */
    protected $propertyAsAddress;

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
     * @var string $country
     * @ODM\Field(name="country", type="string")
     */
    protected $country;

    
    /**
     * @ODM\ReferenceMany(targetDocument="Payment", cascade="all")
     */
    protected $payments;

    /**
     * @ODM\ReferenceMany(targetDocument="Property", cascade="all")
     */
    protected $properties;
    
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
        $this->createdAt = new \DateTime();
        $this->startAt = new \DateTime();
        $this->properties = new ArrayCollection();
        $this->payments = new ArrayCollection();
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
     * Set phone
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set propertyAsAddress
     * @param boolean $propertyAsAddress
     * @return $this
     */
    public function setPropertyAsAddress($propertyAsAddress)
    {
        $this->propertyAsAddress = $propertyAsAddress;
        return $this;
    }

    /**
     * Get propertyAsAddress
     * @return boolean $propertyAsAddress
     */
    public function getPropertyAsAddress()
    {
        return $this->propertyAsAddress;
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
     * Set country
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add payments
     * @param Payment $payment
     * @return $this
     */
    public function addPayments(Payment $payment)
    {
        $this->payments[] = $payment;
        return $this;
    }

    /**
     * Get payments
     * @return Payment[]
     */
    public function getPayments()
    {
        return $this->payments;
    }
    
    /**
     * Add property
     * @param Property $property
     * @return $this
     */
    public function addProperties(Property $property)
    {
        $this->properties[] = $property;
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
