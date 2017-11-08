<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="payment")
 */
class Payment
{
    /**
     * @Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $amount;

    /**
     * @MongoDB\Field(type="string")
     */
    private $paymentType;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $checknumber;

    /**
     * @MongoDB\Field(type="string")
     */
    private $banque;

    /**
     * @MongoDB\Field(type="string")
     */
    private $checkname;

    /**
     * @MongoDB\Field(type="date")
     */
    private $receiptdate;

    /**
     * @MongoDB\Field(type="date")
     */
    private $bankingdate;

    /**
     * @MongoDB\Field(type="string")
     */
    private $imageurl;

    /**
     * @MongoDB\Field(type="string")
     */
    private $membershipfeeId;

    
    function setId($id) {
        $this->id = $id;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function setChecknumber($checknumber) {
        $this->checknumber = $checknumber;
    }

    function setBanque($banque) {
        $this->banque = $banque;
    }

    function setCheckname($checkname) {
        $this->checkname = $checkname;
    }

    function setReceiptdate(\DateTime $receiptdate) {
        $this->receiptdate = $receiptdate;
    }

    function setBankingdate(\DateTime $bankingdate) {
        $this->bankingdate = $bankingdate;
    }

    function setImageurl($imageurl) {
        $this->imageurl = $imageurl;
    }

    function setMembershipfeeId($membershipfeeId) {
        $this->membershipfeeId = $membershipfeeId;
    }

    function getId() {
        return $this->id;
    }

    function getAmount() {
        return $this->amount;
    }

    function getChecknumber() {
        return $this->checknumber;
    }

    function getBanque() {
        return $this->banque;
    }

    function getCheckname() {
        return $this->checkname;
    }

    function getReceiptdate() {
        return $this->receiptdate;
    }

    function getBankingdate() {
        return $this->bankingdate;
    }

    function getImageurl() {
        return $this->imageurl;
    }

    function getMembershipfeeId() {
        return $this->membershipfeeId;
    }

}

