<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ODM\Document(collection="owner")
 */
class Owner
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $firstName;

    /**
     * @ODM\Field(type="string")
     */
    private $lastName;

    /**
     * @ODM\Field(type="string")
     */
    private $email;

    /**
     * @ODM\Field(type="string")
     */
    private $phone;

    /**
     * @ODM\Field(type="boolean")
     */
    private $propertyAsAddress;

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
     * @EmbedMany(targetDocument="Payment")
     */
    private $payments;
    
    
    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }
    
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPropertyAsAddress($propertyAsAddress) {
        $this->propertyAsAddress = $propertyAsAddress;
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

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPropertyAsAddress() {
        return $this->propertyAsAddress;
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
    
    public function getPayments() {
        return $this->payments;
    }

}