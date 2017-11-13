<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Owner;
use Fds\AslMongoBundle\Document\Membershipfee;
use Fds\AslMongoBundle\Document\Payment;
use Fds\AslMongoBundle\Document\Property;
use Fds\AslMongoBundle\Document\Resident;

/**
 * Common controller.
 */
class CommonController extends Controller
{
    /**
     * @return DocumentManager
     */
    protected function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
    
    /*
     * @return integer last document identifier + one
     */
    protected function getIdPlusOneAdded($document)
    {
        $mongoService = 
            $this->container->get('fds_mongoservice.mongoservice');
        return $mongoService->getIdPlusOneAdded($document);
    }
    
    /**
     * @return FOSView
     */
    protected function postCreate($url)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->postCreate($url);
    }
    
    /**
     * @return FOSView
     */
    protected function createUser($data)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->postCreateUser($data);
    }
    
    /**
     * @return FOSView
     */
    protected function getRead($data)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->getRead($data);
    }
    
    /**
     * @return FOSView
     */
    protected function patchUpdateModify()
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->patchUpdateModify();
    }
    
    /**
     * @return FOSView
     */
    protected function deleteDelete()
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->deleteDelete();
    }
    
    /**
     * @return FOSView
     */
    protected function conflict($data)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->conflict($data);
    }
    
    /**
     * @return FOSView 
     */
    protected function notFound($document)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->notFound($document);
    }
    
    
    /**
     * @return FOSView 
     */
    protected function documentTracked($document)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->documentTracked($document);
    }
    
    /**
     * @return void 
     */
    protected function clearCache()
    {
        $cacheService = 
            $this->container->get('fds_cacheservice.cacheservice');
        $cacheService->clearCache();
    }
    
    protected function aslExist($asl_id) {
        $asl = $this->getDocumentManager()->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $asl_id);
        
        if ($asl instanceof Asl) {
            return $asl;
        } else {
            return false;
        }
    }
    
    protected function membershipfeeExist($membershipfee_id, $asl) {
        $criteria = [
            'identifier' => (int) $membershipfee_id,
            'asl' => $asl
        ];
        $membershipfee = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Membershipfee')
            ->findOneBy($criteria);

        if ($membershipfee instanceof Membershipfee) {
            return $membershipfee;
        } else {
            return false;
        }
    }
    
    protected function ownerExist($owner_id, $asl, $property) {
        $criteria = [
            'identifier' => (int) $owner_id,
            'asl' => $asl,
            'properties' => $property
        ];
        $owner = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Owner')
            ->findOneBy($criteria);

        if ($owner instanceof Owner) {
            return $owner;    
        } else {
            return false;
        }
    }
    
    protected function paymentExist($payment_id, $asl, $owner) {
        $criteria = [
            'identifier' => (int) $payment_id,
            'asl' => $asl, 
            'owner' => $owner
        ];
        $payment = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Payment')
            ->findOneBy($criteria);
            
        if ($payment instanceof Payment) {
            return $payment;
        } else {
            return false;
        }
    }
    
    protected function propertyExist($property_id, $asl) {
        $criteria = [
            'identifier' => (int) $property_id,
            'asl' => $asl
        ];
        $property = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Property')
            ->findOneBy($criteria);
            
        if ($property instanceof Property) {
            return $property;
        } else {
            return false;
        }
    }
    
    protected function residentExist($resident_id, $asl, $property) {
        $criteria = [
            'identifier' => (int) $resident_id,
            'asl' => $asl,
            'property' => $property
        ];
        $resident = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Resident')
            ->findOneBy($criteria);
            
        if ($resident instanceof Resident) {
            return $resident;
        } else {
            return false;
        }
    }
    
}