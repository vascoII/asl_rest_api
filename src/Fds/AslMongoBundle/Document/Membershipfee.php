<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AslMongoBundle\Document\Membershipfee
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AslMongoBundle\Repository\MembershipfeeRepository"
 * )
 */
class Membershipfee
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
     * @var date $year
     * @ODM\Field(name="year", type="date")
     */
    protected $year;

    /**
     * @var float $fee
     * @ODM\Field(name="fee", type="float")
     */
    protected $fee;
    
    /**
     * @ODM\ReferenceOne(targetDocument="Asl")
     */
    protected $asl;

    /** 
     * @var date createdAt
     * @ODM\Field(type="date") 
     */
    protected $createdAt;
    
    
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
     * Set year
     * @param date $year
     * @return $this
     */
    public function setYear(\DateTime $year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * Get year
     * @return date $year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set fee
     * @param float $fee
     * @return $this
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
        return $this;
    }

    /**
     * Get fee
     * @return float $fee
     */
    public function getFee()
    {
        return $this->fee;
    }
    
    /**
     * Set asl
     * @param Asl $asl
     * @return $this
     */
    public function setAsl($asl)
    {
        $this->asl = $asl;
        return $this;
    }

    /**
     * Get asl
     * @return Asl $asl
     */
    public function getAsl()
    {
        return $this->asl;
    }
    
    /**
     * Get createAt
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
}
