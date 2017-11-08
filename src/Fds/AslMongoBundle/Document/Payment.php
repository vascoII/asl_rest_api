<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
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

    
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setAmount($amount) 
    {
        $this->amount = $amount;
    }

    public function setCheckNumber($checkNumber) 
    {
        $this->checkNumber = $checkNumber;
    }

    public function setBanque($banque) 
    {
        $this->banque = $banque;
    }

    public function setCheckName($checkName) 
    {
        $this->checkName = $checkName;
    }

    public function setReceiptDate(\DateTime $receiptDate) 
    {
        $this->receiptDate = $receiptDate;
    }

    public function setBankingDate(\DateTime $bankingDate) 
    {
        $this->bankingDate = $bankingDate;
    }

    public function setImageUrl($imageUrl) 
    {
        $this->imageUrl = $imageUrl;
    }

    public function setMembershipfeeId($membershipfeeId) 
    {
        $this->membershipfeeId = $membershipfeeId;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getAmount() 
    {
        return $this->amount;
    }

    public function getCheckNumber() 
    {
        return $this->checkNumber;
    }

    public function getBanque() 
    {
        return $this->banque;
    }

    public function getCheckName() 
    {
        return $this->checkName;
    }

    public function getReceiptDate() 
    {
        return $this->receiptDate;
    }

    public function getBankingDate() 
    {
        return $this->bankingDate;
    }

    public function getImageUrl() 
    {
        return $this->imageUrl;
    }

    public function getMembershipfeeId() 
    {
        return $this->membershipfeeId;
    }

}

