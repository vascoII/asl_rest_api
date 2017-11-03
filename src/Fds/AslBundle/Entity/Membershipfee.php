<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membershipfee
 *
 * @ORM\Table(name="membershipfee", indexes={@ORM\Index(name="FK_EFBBF54824E8B3DA", columns={"asl_id"})})
 * @ORM\Entity
 */
class Membershipfee
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
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="fee", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $fee;

    /**
     * @var Asl
     *
     * @ORM\ManyToOne(targetEntity="Asl", inversedBy="membershipfees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asl_id", referencedColumnName="id")
     * })
     */
    private $asl;


    function setYear(\DateTime $year) {
        $this->year = $year;
    }

    function setFee($fee) {
        $this->fee = $fee;
    }

    function setAsl(Asl $asl) {
        $this->asl = $asl;
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

    function getAsl() {
        return $this->asl;
    }


}

