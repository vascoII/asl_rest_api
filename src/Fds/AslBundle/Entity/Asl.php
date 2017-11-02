<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Asl
 *
 * @ORM\Table(name="asl")
 * @ORM\Entity
 */
class Asl
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="postalcode", type="string", length=255, nullable=false)
     */
    private $postalcode;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    private $country;
    
    /**
     * @ORM\OneToMany(targetEntity="Property", mappedBy="asl")
     * @var Property[]
     */
    private $properties;
    
    /**
     * @ORM\OneToMany(targetEntity="Membershipfee", mappedBy="asl")
     * @var Membershipfee[]
     */
    private $membershipfees;
    
    
    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->membershipfees = new ArrayCollection();
    }
            
    function setName($name) {
        $this->name = $name;
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

    function getName() {
        return $this->name;
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
    
    function getProperties() {
        return $this->properties;
    }

    function getMembershipfees() {
        return $this->membershipfees;
    }

}

