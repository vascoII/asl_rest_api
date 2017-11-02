<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Propertytype
 *
 * @ORM\Table(name="propertytype")
 * @ORM\Entity
 */
class Propertytype
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
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;


    function setType($type) {
        $this->type = $type;
    }

    function getId() {
        return $this->id;
    }

    function getType() {
        return $this->type;
    }


}

