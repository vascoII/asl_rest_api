<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Membershipfee
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @ODM\Field(type="date")
     */
    private $year;

    /**
     * @ODM\Field(type="string")
     */
    private $fee;

    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setYear(\DateTime $year) 
    {
        $this->year = $year;
    }

    public function setFee($fee) 
    {
        $this->fee = $fee;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getYear() 
    {
        return $this->year;
    }

    public function getFee() 
    {
        return $this->fee;
    }

}

