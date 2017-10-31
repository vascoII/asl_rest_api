<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="membershipfee",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="membershipfee_year_asl_unique",
 *              columns={"year", "asl_id"}
 *          )
 *      }
 * )
 */
class MembershipFee
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @ORM\Column(type="string")
     */
    private $fee;

    /**
     * @ORM\ManyToOne(targetEntity="Asl", inversedBy="membershipfees")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $asl;
    
    public function getId()
    {
        return $this->id;
    }

    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setFee($fee)
    {
        $this->fee = $fee;
        return $this;
    }

    public function getFee()
    {
        return $this->fee;
    }
    
    public function setAsl(Asl $asl)
    {
        $this->asl = $asl;
        return $this;
    }

    public function getAsl()
    {
        return $this->asl;
    }
}

