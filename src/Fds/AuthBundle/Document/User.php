<?php

namespace Fds\AuthBundle\Document;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AuthBundle\Document\User
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AuthBundle\Repository\UserRepository"
 * )
 */
class User implements UserInterface
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
     * @var string $email
     * @ODM\Field(name="email", type="string")
     */
    protected $email;
    
    /**
     * @var string $role
     * @ODM\Field(name="role", type="string")
     */
    protected $role;
    
    /**
     * @var string $password
     * @ODM\Field(name="password", type="string")
     */
    protected $password;

    protected $plainPassword;
    
    
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
     * Set role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     * @return string $role
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * Set password
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getRoles()
    {
        return [];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // Suppression des données sensibles
        $this->plainPassword = null;
    }
}
