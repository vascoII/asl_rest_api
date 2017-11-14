<?php

namespace Fds\AuthBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Fds\AuthBundle\Document\User;

/**
 * Fds\AuthBundle\Document\AuthToken
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AuthBundle\Repository\AuthTokenRepository"
 * )
 */
class AuthToken
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
     * @var string $value
     * @ODM\Field(name="value", type="string")
     */
    protected $value;

    /** 
     * @ODM\Field(type="date") 
     */
    protected $createdAt;

    /**
     * @ODM\ReferenceOne(targetDocument="User")
     */
    protected $user;


    public function __construct() 
    {
        $this->createdAt = new \DateTime();
    }
    
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
     * Set value
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
    /**
     * Get value
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get createAt
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set user
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
    
    /**
     * Get user
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    
}