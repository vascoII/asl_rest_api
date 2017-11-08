<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="payment")
 */
class Payment
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $amount;

    /**
     * @ODM\Field(type="string")
     */
    private $paymentType;
    
    /**
     * @ODM\Field(type="string")
     */
    private $checkNumber;

    /**
     * @ODM\Field(type="string")
     */
    private $banque;

    /**
     * @ODM\Field(type="string")
     */
    private $checkName;

    /**
     * @ODM\Field(type="date")
     */
    private $receiptDate;

    /**
     * @ODM\Field(type="date")
     */
    private $bankingDate;

    /**
     * @ODM\Field(type="string")
     */
    private $imageUrl;

    /**
     * @ODM\Field(type="string")
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

