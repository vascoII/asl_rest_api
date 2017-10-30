<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="properties",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="properties_number_asl_owner_unique",
 *              columns={"number", "asl_id"}
 *          )
 *      }
 * )
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $number;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="Asl", inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $asl;
    
    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $owner;
    
    public function getId()
    {
        return $this->id;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
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
    
    public function setOwner(Owner $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }
}

