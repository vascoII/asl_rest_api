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
    protected $payments = array();

    /** 
     * @var date createdAt
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
     * Set payments
     * @param Payment $payment
     * @return $this
     */
    public function setPayments(Payment $payment)
    {
        array_push($this->payments, $payment);
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
