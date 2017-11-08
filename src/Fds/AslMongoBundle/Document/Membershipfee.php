<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="membershipfee")
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

    function setYear(\DateTime $year) {
        $this->year = $year;
    }

    function setFee($fee) {
        $this->fee = $fee;
    }

    function getId() {
        return $this->id;
    }

    function getYear() {
        return $this->year;
    }

    function getFee() {
        return $this->fee;
    }

}

