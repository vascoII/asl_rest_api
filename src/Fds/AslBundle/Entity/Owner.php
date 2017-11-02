<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Owner
 *
 * @ORM\Table(name="owner")
 * @ORM\Entity
 */
class Owner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="propertyAsAddress", type="boolean", nullable=true)
     */
    private $propertyasaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=255, nullable=false)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    private $country;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Fds\AslBundle\Entity\Property", mappedBy="resident")
     */
    private $property;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->property = new ArrayCollection();
    }


    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setPropertyasaddress($propertyasaddress) {
        $this->propertyasaddress = $propertyasaddress;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setCountry($country) {
        $this->country = $country;
    }
    
    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getPropertyasaddress() {
        return $this->propertyasaddress;
    }

    function getAddress() {
        return $this->address;
    }

    function getPostalcode() {
        return $this->postalcode;
    }

    function getCity() {
        return $this->city;
    }

    function getCountry() {
        return $this->country;
    }
    
    function getProperty() {
        return $this->property;
    }

}

