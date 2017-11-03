<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Property
 *
 * @ORM\Table(name="property", indexes={@ORM\Index(name="FK_8BF21CDE24E8B3DA", columns={"asl_id"}), @ORM\Index(name="FK_8BF21CDE9C81C6EB", columns={"propertytype_id"})})
 * @ORM\Entity
 */
class Property
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
     * @ORM\Column(name="number", type="string", length=255, nullable=false)
     */
    private $number;

    /**
     * @var Propertytype
     *
     * @ORM\ManyToOne(targetEntity="Propertytype", inversedBy="properties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="propertytype_id", referencedColumnName="id")
     * })
     */
    private $propertytype;

    /**
     * @var Asl
     *
     * @ORM\ManyToOne(targetEntity="Asl", inversedBy="properties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asl_id", referencedColumnName="id")
     * })
     */
    private $asl;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Resident", cascade={"persist"})
     *  
     */
    private $residents;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Owner", cascade={"persist"})
     * 
     */
    private $owners;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->residents = new ArrayCollection();
        $this->owners = new ArrayCollection();
    }
    
    function setNumber($number) {
        $this->number = $number;
    }
    
    function getId() {
        return $this->id;
    }

    function getNumber() {
        return $this->number;
    }

    function getPropertytype() {
        return $this->propertytype;
    }

    function getAsl() {
        return $this->asl;
    }

    function getResidents() {
        return $this->residents;
    }
    
    function getOwners() {
        return $this->owners;
    }


}

