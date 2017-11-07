<?php

namespace Fds\AslMongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var \Fds\AslBundle\Entity\Membershipfee
     *
     * @ORM\ManyToOne(targetEntity="Fds\AslBundle\Entity\Membershipfee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="membershipfee_id", referencedColumnName="id")
     * }) 
     */
    private $membershipfee;

    /**
     * @var \Fds\AslBundle\Entity\Property
     *
     * @ORM\ManyToOne(targetEntity="Property")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     * })
     */
    private $property;

    /**
     * @var \Fds\AslBundle\Entity\Paymenttype
     *
     * @ORM\ManyToOne(targetEntity="Paymenttype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_type_id", referencedColumnName="id")
     * })
     */
    private $paymentType;


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

    function setMembershipfee(Membershipfee $membershipfee) {
        $this->membershipfee = $membershipfee;
    }

    function setProperty(Property $property) {
        $this->property = $property;
    }

    function setPaymentType(Paymenttype $paymentType) {
        $this->paymentType = $paymentType;
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

    function getMembershipfee() {
        return $this->membershipfee;
    }

    function getProperty() {
        return $this->property;
    }

    function getPaymentType() {
        return $this->paymentType;
    }

    
}

