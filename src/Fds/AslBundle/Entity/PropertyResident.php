<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyResident
 *
 * @ORM\Table(name="property_resident", indexes={@ORM\Index(name="resident_property_fk", columns={"resident_id"})})
 * @ORM\Entity
 */
class PropertyResident
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
     * @ORM\Column(name="resident_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $residentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date", nullable=true)
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

    function getResidentId() {
        return $this->residentId;
    }

    function getStartdate() {
        return $this->startdate;
    }

    function getEnddate() {
        return $this->enddate;
    }


}

