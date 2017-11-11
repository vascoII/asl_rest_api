<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Membershipfee;
use Fds\AslMongoBundle\Document\Owner;
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
    protected function noDocumentFound($document)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->noDocumentFound($document);
    }
    
    /**
     * @return FOSView 
     */
    protected function documentRemoved($document)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->documentRemoved($document);
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
     * @return FOSView 
     */
    protected function documentRemoveNotAllowed($document, $childrens)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->documentRemoveNotAllowed($document, $childrens);
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
        
        if ($asl) {
            return $asl;
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
    protected function membershipfeeExist($membershipfee_id, $asl) {
        $criteria = [
            'identifier' => (int) $membershipfee_id,
            'asl' => $asl
        ];
        $membershipfee = $this->dm->getRepository('FdsAslMongoBundle:Membershipfee')
            ->findOneBy($criteria);

        if ($membershipfee) {
            return $membershipfee;
        } else {
            return $this->noDocumentFound($this->getParameter('constant_membershipfee'));
        }
    }
    
    protected function ownerExist($owner_id, $asl, $property) {
        $criteria = [
            'identifier' => (int) $owner_id,
            'asl' => $asl,
            'property' => $property
        ];
        $owner = $this->dm->getRepository('FdsAslMongoBundle:Owner')
            ->findOneBy($criteria);

        if ($owner) {
            return $owner;    
        } else {
            return $this->noDocumentFound($this->getParameter('constant_owner'));
        }
    }
    
    protected function paymentExist($payment_id, $asl, $owner) {
        $criteria = [
            'identifier' => (int) $payment_id,
            'asl' => $asl, 
            'owner' => $owner
        ];
        $payment = $this->dm->getRepository('FdsAslMongoBundle:Payment')
            ->findOneBy($criteria);
            
        if ($payment) {
            return $payment;
        } else {
            return $this->noDocumentFound($this->getParameter('constant_payment'));
        }
    }
    
    protected function propertyExist($property_id, $asl) {
        $criteria = [
            'identifier' => (int) $property_id,
            'asl' => $asl
        ];
        $property = $this->dm->getRepository('FdsAslMongoBundle:Property')
            ->findOneBy($criteria);
            
        if ($property) {
            return $property;
        } else {
            return $this->noDocumentFound($this->getParameter('constant_property'));
        }
    }
    
    protected function residentExist($resident_id, $asl, $property) {
        $criteria = [
            'identifier' => (int) $resident_id,
            'asl' => $asl,
            'property' => $property
        ];
        $resident = $this->dm->getRepository('FdsAslMongoBundle:Resident')
            ->findOneBy($criteria);
            
        if ($resident) {
            return $resident;
        } else {
            return $this->noDocumentFound($this->getParameter('constant_resident'));
        }
    }
}