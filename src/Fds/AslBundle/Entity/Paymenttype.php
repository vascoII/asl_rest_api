<?php

namespace Fds\AslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paymenttype
 *
 * @ORM\Table(name="paymenttype")
 * @ORM\Entity
 */
class Paymenttype
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

