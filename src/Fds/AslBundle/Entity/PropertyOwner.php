<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyOwner
 *
 * @ORM\Table(name="property_owner", indexes={@ORM\Index(name="owner_property_fk", columns={"owner_id"})})
 * @ORM\Entity
 */
class PropertyOwner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="property_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $propertyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ownerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=true)
     */
    private $enddate;


    function setStartdate(\DateTime $startdate) {
        $this->startdate = $startdate;
    }

    function setEnddate(\DateTime $enddate) {
        $this->enddate = $enddate;
    }
    
    function getPropertyId() {
        return $this->propertyId;
    }

    function getOwnerId() {
        return $this->ownerId;
    }

    function getStartdate() {
        return $this->startdate;
    }

    function getEnddate() {
        return $this->enddate;
    }


}

