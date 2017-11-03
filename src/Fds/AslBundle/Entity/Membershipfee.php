<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="membershipfee",
 *      uniqueConstraints={@ORM\UniqueConstraint(
 *          name="year_asl_unique", columns={"year", "asl_id"})
 *      }
 * )
 */
class Membershipfee
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="year", type="date", nullable=false)
     */
    private $year;

    /**
     * @var string
     * @ORM\Column(name="fee", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $fee;

    /**
     * @var Asl
     * @ORM\ManyToOne(targetEntity="Asl", inversedBy="membershipfees")
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

