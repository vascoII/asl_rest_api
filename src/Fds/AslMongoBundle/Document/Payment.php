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
    private $checkNumber;

    /**
     * @MongoDB\Field(type="string")
     */
    private $banque;

    /**
     * @MongoDB\Field(type="string")
     */
    private $checkName;

    /**
     * @MongoDB\Field(type="date")
     */
    private $receiptDate;

    /**
     * @MongoDB\Field(type="date")
     */
    private $bankingDate;

    /**
     * @MongoDB\Field(type="string")
     */
    private $imageUrl;

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

    function setCheckNumber($checkNumber) {
        $this->checkNumber = $checkNumber;
    }

    function setBanque($banque) {
        $this->banque = $banque;
    }

    function setCheckName($checkName) {
        $this->checkName = $checkName;
    }

    function setReceiptDate(\DateTime $receiptDate) {
        $this->receiptDate = $receiptDate;
    }

    function setBankingDate(\DateTime $bankingDate) {
        $this->bankingDate = $bankingDate;
    }

    function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
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

    function getCheckNumber() {
        return $this->checkNumber;
    }

    function getBanque() {
        return $this->banque;
    }

    function getCheckName() {
        return $this->checkName;
    }

    function getReceiptDate() {
        return $this->receiptDate;
    }

    function getBankingDate() {
        return $this->bankingDate;
    }

    function getImageUrl() {
        return $this->imageUrl;
    }

    function getMembershipfeeId() {
        return $this->membershipfeeId;
    }

}

