<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslMongoBundle\Document\Membershipfee;

/**
 * Membershipfee controller.
 */
class MembershipfeeController extends CommonController
{
    public function getMembershipfeesAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $asls = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findAll();

        if (!$asls) {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
        
        return new Response($serializer->serialize($asls, 'json'));
    }
    
    public function getMembershipfeeAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        /* @var $asl Asl */
        if (!$asl) {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
        
        return new Response($serializer->serialize($asl, 'json'));
    }
    
    public function postMembershipfeeAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $membershipfee = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Membershipfee')
            ->createMembershipfee(
                $request->request, 
                $this->getIdPlusOneAdded(
                    $this->getParameter('constant_membershipfee')
                ),
                (int) $request->get('asl_id')
            );            
        
        return new Response($serializer->serialize($membershipfee, 'json'));
    }
    
    public function deleteMembershipfeeAction(Request $request)
    {
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
;            
        if ($asl) {
            $aslName = $asl->getName();
            $dm->remove($asl);
            $dm->flush();
            return $this->documentRemoved($aslName);
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
    public function patchMembershipfeeAction(Request $request)
    {  
        $serializer = $this->get('jms_serializer');
        
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        
        if ($asl) {
            $aslUpdated = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findAndUpdateAsl($request->request, $asl);            

            return new Response($serializer->serialize($aslUpdated, 'json'));
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
}
