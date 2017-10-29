<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="properties",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="properties_number_asl_unique",columns={"number", "asl_id"}
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
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     * @param string $number
     * @return Property
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type
     * @param string $type
     * @return Property
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set asl
     * @param Asl $asl
     * @return Property
     */
    public function setAsl(Asl $asl)
    {
        $this->asl = $asl;
        return $this;
    }

    /**
     * Get asl
     * @return string
     */
    public function getAsl()
    {
        return $this->asl;
    }
}

