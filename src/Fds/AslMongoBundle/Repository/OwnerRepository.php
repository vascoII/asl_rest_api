<?php

namespace Fds\AslMongoBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Fds\AslMongoBundle\Document\Owner;

/**
 * OwnerRepository
 *
 * This class was generated by the Doctrine ODM. Add your own custom
 * repository methods below.
 */
class OwnerRepository extends DocumentRepository
{
    public function createOwner($request, $identifier, $asl, $property) {
                        
        $owner = new Owner();
        $owner->setIdentifier($identifier);
        $owner->setFirstName($request->request->get('firstName'));
        $owner->setLastName($request->request->get('lastName'));
        $owner->setEmail($request->request->get('email'));
        $owner->setPhone($request->request->get('phone'));
        $owner->setPropertyAsAddress($request->request->get('propertyAsAddress'));
        if (!$request->request->get('propertyAsAddress')) {
            $owner->setAddress($request->request->get('address'));
            $owner->setPostalCode($request->request->get('postalCode'));
            $owner->setCity($request->request->get('city'));
            $owner->setCountry($request->request->get('country'));
        }
        if ($request->request->get('startAt')) {
            //Format string to DateTime
            $date = new \DateTime($request->request->get('startAt'));
            $owner->setStartAt($date);
        }
        $owner->setAsl($asl);
        $owner->addProperties($property);                
            
        $this->dm->persist($owner);
                
        $property->addOwners($owner);
        $this->dm->persist($property);
            
        $this->dm->flush();
        
        return $owner;
    }
    
    public function deleteOwner($owner, $property) {
        //remove owner reference in Property Document
        $property->getOwners()->removeElement($owner);
        $this->dm->persist($property);
        //Remove Document owner
        $this->dm->remove($owner);
                    
        $this->dm->flush();      
    }
    
    public function keepTrackOwner($owner, $property, $endAt) {                  
        //remove owner reference in Property Document
        $property->getResidents()->removeElement($owner);
        $this->dm->persist($property);
        //Add endAt to owner Element and delete relation to Property Element
        //Format string to DateTime
        $date = new \DateTime($endAt);
        $owner->setEndAt($date);
        $owner->setProperty('');
        
        $this->dm->flush();           
    }
    
    public function findAndUpdateOwner($request, $owner)
    {
        $ownerUpdate = $this->dm
            ->createQueryBuilder('FdsAslMongoBundle:Owner')
            ->findAndUpdate()
            ->field('identifier')->equals((int) $owner->getIdentifier());
        // Update found resident
        foreach ($request->request->all() as $key => $value) {
            $ownerUpdate->field($key)->set($value);
        }
        
        $ownerUpdate->getQuery()->execute();
    }
    
}
