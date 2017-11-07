<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="membershipfee")
 */
class Membershipfee
{
    /**
     * @Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @MongoDB\Field(type="date")
     */
    private $year;

    /**
     * @MongoDB\Field(type="string")
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

