<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslMongoBundle\Document\Membershipfee;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * Membershipfee controller.
 */
class MembershipfeeController extends CommonController
{
    /**
     * @FOSRest\View(serializerGroups={"membershipfees"})
     */
    public function getMembershipfeesAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));

        if ($asl) {
            $membershipfees = $asl->getMembershipfees();
            if (count($membershipfees)) {
                return new Response($serializer->serialize($membershipfees, 'json'));
            } else {
                return $this->noDocumentFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
    public function getMembershipfeeAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $dm = $this->getDocumentManager();
        
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));

        if ($asl) {          
            $membershipfees = $asl->getMembershipfees();
            foreach ($membershipfees as $membershipfee) {
                if (
                    (int) $membershipfee->getIdentifier() == 
                    (int) $request->get('membershipfee_id')
                ) {
                    return new Response(
                        $serializer->serialize($membershipfee, 'json')
                    );
                }
            }
                
            return $this->noDocumentFound(
                $this->getParameter('constant_membershipfee')
            );
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
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
                (int) $request->get('asl_id'),
                $this->noDocumentFound($this->getParameter('constant_asl'))
            );            
        
        return new Response($serializer->serialize($membershipfee, 'json'));
    }
    
    public function deleteMembershipfeeAction(Request $request)
    { 
        $membershipfee = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Membershipfee')
            ->deleteMembershipfee(
                (int) $request->get('asl_id'),
                (int) $request->get('membershipfee_id'),
                $this->noDocumentFound($this->getParameter('constant_asl')),
                $this->noDocumentFound($this->getParameter('constant_membershipfee')),
                $this->documentRemoved('Membershipfee')
            );
          
        return $membershipfee;
    }
    
    public function patchMembershipfeeAction(Request $request)
    {  
        $serializer = $this->get('jms_serializer');
        
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        
        if ($asl) {
            $membershipfee = $dm->getRepository('FdsAslMongoBundle:Membershipfee')
                ->findOneByIdentifier((int) $request->get('membershipfee_id'));
            
            if ($membershipfee) {
                $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Membershipfee')
                    ->findAndUpdateMembership($request->request, $membershipfee);            

                $membershipfee = 
                    $dm->getRepository('FdsAslMongoBundle:Membershipfee')
                        ->findOneByIdentifier(
                            (int) $request->get('membershipfee_id')
                        );
                return new Response(
                    $serializer->serialize($membershipfee, 'json')
                );
            } else {
                return $this->noDocumentFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
}
