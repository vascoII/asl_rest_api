<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="owners",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="owner_firstName_lastName_email_unique",columns={"first_name", "last_name", "email"}
 *          )
 *      }
 * )
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="boolean", unique=false, nullable=false)
     */
    protected $propertyAsAdress;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $postalCode;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="Property", mappedBy="owner")
     * @var Property[]
     */
    protected $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPropertyAsAdress($propertyAsAdress)
    {
        $this->propertyAsAdress = $propertyAsAdress;

        return $this;
    }

    public function getPropertyAsAdress()
    {
        return $this->propertyAsAdress;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }
    
    public function getProperties()
    {
        return $this->properties;
    }
}

