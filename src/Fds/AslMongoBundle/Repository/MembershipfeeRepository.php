<?php

namespace Fds\AslMongoBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Fds\AslMongoBundle\Document\Membershipfee;

/**
 * MembershipfeeRepository
 *
 * This class was generated by the Doctrine ODM. Add your own custom
 * repository methods below.
 */
class MembershipfeeRepository extends DocumentRepository
{
    public function createMembershipfee(
        $datas, 
        $identifier, 
        $asl_id, 
        $noDocumentFound
    ) {
        $asl = $this->dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $asl_id);
        
        if ($asl) {
            //Format string to DateTime
            $date = new \DateTime($datas->get('year'));
            
            $membershipfee = new Membershipfee();
            $membershipfee->setIdentifier($identifier);
            $membershipfee->setYear($date);
            $membershipfee->setFee($datas->get('fee'));
            $membershipfee->setAsl($asl);
            $membershipfee->setCreatedAt(new \DateTime());
            
            $this->dm->persist($membershipfee);
            
            $asl->addMembershipfees($membershipfee);
            $this->dm->persist($asl);
        } else {
            return $noDocumentFound;
        }
        
        $this->dm->flush();
        
        return $membershipfee;
    }
    
    
    public function deleteMembershipfee(
        $asl_id, 
        $membershipfee_id,
        $noDocumentFoundAsl,
        $noDocumentFoundMembershipfee,
        $documentRemoved
    ) {
        $asl = $this->dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $asl_id);
        
        if ($asl) {
            $membershipfees = $asl->getMembershipfees();
            foreach ($membershipfees as $membershipfee) {
                if (
                    (int) $membershipfee->getIdentifier() == 
                    (int) $membershipfee_id
                ) {
                    $this->dm->remove($membershipfee);
                    $this->dm->flush();
                    return $documentRemoved;
                }
            }
            return $noDocumentFoundMembershipfee;
        } else {
            return $noDocumentFoundAsl;
        }
        
        $this->dm->flush();
        
        return $membershipfee;
    }
}