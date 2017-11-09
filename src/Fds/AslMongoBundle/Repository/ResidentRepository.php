<?php

namespace Fds\AslMongoBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Fds\AslMongoBundle\Document\Resident;

/**
 * ResidentRepository
 *
 * This class was generated by the Doctrine ODM. Add your own custom
 * repository methods below.
 */
class ResidentRepository extends DocumentRepository
{
    public function createResident($datas, $identifier)
    {
        $resident = new Resident();
        $resident->setIdentifier($identifier);
        $resident->setFirstName($datas->get('firstName'));
        $resident->setLastName($datas->get('lastName'));
        $resident->setEmail($datas->get('email'));
        $resident->setCreatedAt(new \DateTime());

        $this->dm->persist($resident);
        $this->dm->flush();
        
        return $resident;
    }
    
}
