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
     * @ODM\eferenceOne(targetDocument="Membershipfee")
     */
    protected $asl;

    /** 
     * @var date createdAt
     * @ODM\Field(type="date") 
     */
    protected $createdAt;
    
    
    /**
     * Get id
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
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
     * Set createdAt
     * @param date $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
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
