<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="asls",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="asls_name_unique",columns={"name"})}
 * )
 */
class Asl
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $postalCode;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $city;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $country;
    
    /**
     * @ORM\OneToMany(targetEntity="Property", mappedBy="asl")
     * @var Property[]
     */
    protected $properties;
    
    /**
     * @ORM\ManyToMany(targetEntity="Owner", cascade={"persist"})
     * @var Owner[]
     */
    protected $owners;
    
    /**
     * @ORM\ManyToMany(targetEntity="Resident", cascade={"persist"})
     * @var Resident[]
     */
    protected $residents;
  

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->owners = new ArrayCollection();
        $this->residents = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }
    
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
    
    public function getProperties()
    {
        return $this->properties;
    }
    
    public function addOwner(Owner $owner)
    {
        $this->owners[] = $owner;
        return $this;
    }

    public function removeOwner(Owner $owner)
    {
        $this->owners->removeElement($owner);
    }
    
    public function getOwners()
    {
        return $this->owners;
    }
    
    public function addResident(Resident $resident)
    {
        $this->residents[] = $resident;
        return $this;
    }

    public function removeResident(Resident $resident)
    {
        $this->residents->removeElement($resident);
    }
    
    public function getResidents()
    {
        return $this->residents;
    }
    
}