<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment", indexes={@ORM\Index(name="FK_6D28840DDC058279", columns={"payment_type_id"}), @ORM\Index(name="FK_6D28840D549213EC", columns={"property_id"}), @ORM\Index(name="FK_6D28840D2DB0665B", columns={"membershipfee_id"})})
 * @ORM\Entity
 */
class Payment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="checkNumber", type="string", length=255, nullable=true)
     */
    private $checknumber;

    /**
     * @var string
     *
     * @ORM\Column(name="banque", type="string", length=255, nullable=true)
     */
    private $banque;

    /**
     * @var string
     *
     * @ORM\Column(name="checkName", type="string", length=255, nullable=true)
     */
    private $checkname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="receiptDate", type="date", nullable=false)
     */
    private $receiptdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bankingDate", type="date", nullable=false)
     */
    private $bankingdate;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUrl", type="string", length=255, nullable=true)
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
     * @ORM\ManyToOne(targetEntity="Fds\AslBundle\Entity\Property")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     * })
     */
    private $property;

    /**
     * @var \Fds\AslBundle\Entity\Paymenttype
     *
     * @ORM\ManyToOne(targetEntity="Fds\AslBundle\Entity\Paymenttype")
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

