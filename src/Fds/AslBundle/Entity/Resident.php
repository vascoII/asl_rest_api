<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="residents",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="residents_firstName_lastName_email_phone_unique",
 *              columns={"first_name", "last_name", "email", "phone"}
 *          )
 *      }
 * )
 */
class Resident
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
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastName;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $phone; 
    
    /**
     * @ORM\OneToMany(targetEntity="Property", mappedBy="resident")
     * @var Resident[]
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
    
    public function getProperties()
    {
        return $this->properties;
    }
}

