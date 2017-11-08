<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="resident")
 */
class Resident
{
    /**
     * @Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $firstName;

    /**
     * @MongoDB\Field(type="string")
     */
    private $lastName;

    /**
     * @MongoDB\Field(type="string")
     */
    private $email;

    /**
     * @MongoDB\Field(type="string")
     */
    private $phone;

    
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

}