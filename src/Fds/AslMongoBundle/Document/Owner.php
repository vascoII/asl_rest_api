<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="resident")
 */
class Owner
{
    /**
     * @Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $firstname;

    /**
     * @MongoDB\Field(type="string")
     */
    private $lastname;

    /**
     * @MongoDB\Field(type="string")
     */
    private $email;

    /**
     * @MongoDB\Field(type="string")
     */
    private $phone;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $propertyasaddress;

    /**
     * @MongoDB\Field(type="string")
     */
    private $address;

    /**
     * @MongoDB\Field(type="string")
     */
    private $postalcode;

    /**
     * @MongoDB\Field(type="string")
     */
    private $city;

    /**
     * @MongoDB\Field(type="string")
     */
    private $country;
    
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPropertyasaddress($propertyasaddress) {
        $this->propertyasaddress = $propertyasaddress;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
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

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPropertyasaddress() {
        return $this->propertyasaddress;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }

}