<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Fds\AslMongoBundle\Document\Payment
 *
 * @ODM\Document(
 *     repositoryClass="Fds\AslMongoBundle\Repository\PaymentRepository"
 * )
 */
class Payment
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
     * @var float $amount
     * @ODM\Field(name="amount", type="float")
     */
    protected $amount;

    /**
     * @var string $paymentType
     * @ODM\Field(name="paymentType", type="string")
     */
    protected $paymentType;

    /**
     * @var string $checkNumber
     * @ODM\Field(name="checkNumber", type="string")
     */
    protected $checkNumber;

    /**
     * @var string $banque
     * @ODM\Field(name="banque", type="string")
     */
    protected $banque;

    /**
     * @var string $checkName
     * @ODM\Field(name="checkName", type="string")
     */
    protected $checkName;

    /**
     * @var date $receiptDate
     * @ODM\Field(name="receiptDate", type="date")
     */
    protected $receiptDate;

    /**
     * @var date $bankingDate
     * @ODM\Field(name="bankingDate", type="date")
     */
    protected $bankingDate;

    /**
     * @var string $imageUrl
     * @ODM\Field(name="imageUrl", type="string")
     */
    protected $imageUrl;

    /**
     * @ODM\ReferenceOne(targetDocument="Membershipfee")
     */
    protected $owner;
    
    /**
     * @ODM\ReferenceMany(targetDocument="Membershipfee", cascade="all")
     */
    protected $membershipfees;
    

    /** 
     * @var date createdAt
     * @ODM\Field(type="date") 
     */
    protected $createdAt;

    
    public function __construct() 
    {
        $this->createdAt = new \DateTime();
        $this->membershipfees = new ArrayCollection();
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
     * Set amount
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     * @return float $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set paymentType
     * @param string $paymentType
     * @return $this
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * Get paymentType
     * @return string $paymentType
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set checkNumber
     * @param string $checkNumber
     * @return $this
     */
    public function setCheckNumber($checkNumber)
    {
        $this->checkNumber = $checkNumber;
        return $this;
    }

    /**
     * Get checkNumber
     * @return string $checkNumber
     */
    public function getCheckNumber()
    {
        return $this->checkNumber;
    }

    /**
     * Set banque
     * @param string $banque
     * @return $this
     */
    public function setBanque($banque)
    {
        $this->banque = $banque;
        return $this;
    }

    /**
     * Get banque
     * @return string $banque
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Set checkName
     * @param string $checkName
     * @return $this
     */
    public function setCheckName($checkName)
    {
        $this->checkName = $checkName;
        return $this;
    }

    /**
     * Get checkName
     * @return string $checkName
     */
    public function getCheckName()
    {
        return $this->checkName;
    }

    /**
     * Set receiptDate
     * @param date $receiptDate
     * @return $this
     */
    public function setReceiptDate(\DateTime $receiptDate)
    {
        $this->receiptDate = $receiptDate;
        return $this;
    }

    /**
     * Get receiptDate
     * @return date $receiptDate
     */
    public function getReceiptDate()
    {
        return $this->receiptDate;
    }

    /**
     * Set bankingDate
     * @param date $bankingDate
     * @return $this
     */
    public function setBankingDate(\DateTime $bankingDate)
    {
        $this->bankingDate = $bankingDate;
        return $this;
    }

    /**
     * Get bankingDate
     * @return date $bankingDate
     */
    public function getBankingDate()
    {
        return $this->bankingDate;
    }

    /**
     * Set imageUrl
     * @param string $imageUrl
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * Get imageUrl
     * @return string $imageUrl
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set owner
     * @param Owner $owner
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     * @return Owner $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Add membershipfee
     * @param Membershipfee $membershipfee
     * @return $this
     */
    
    public function addMembershipfees(Membershipfee $membershipfee)
    {
        $this->membershipfees[] = $membershipfee;
        return $this;
    }

    /**
     * Get membershipfees
     * @return Membershipfee[]
     */
    public function getMembershipfees()
    {
        return $this->membershipfees;
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
