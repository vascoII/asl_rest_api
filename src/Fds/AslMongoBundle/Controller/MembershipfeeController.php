<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Membershipfee;

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
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_membershipfee')
        );
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Membershipfee')
                ->createMembershipfee(
                    $request, 
                    $getIdPlusOneAdded,
                    $asl
                );
            return $this->responseCreated($request->getUri().'/'.$getIdPlusOneAdded);
        } else {
            return $asl;
        }
    }
    
    public function deleteMembershipfeeAction(Request $request)
    { 
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $membershipfee = $this->membershipfeeExist(
                $request->get('membershipfee_id'), 
                $asl
            );
            if ($membershipfee instanceof Membershipfee) {
                $membershipfee = $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Membershipfee')
                    ->deleteMembershipfee(
                        (int) $request->get('membershipfee_id'),
                        $asl
                    );
                return $this->documentRemoved('Membership');
            } else {
                return $membershipfee;
            }
        } else {
            return $asl;
        }
    }
    
    public function patchMembershipfeeAction(Request $request)
    {  
        $serializer = $this->get('jms_serializer');
        $dm = $this->getDocumentManager();
        
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $membershipfee = $this->membershipfeeExist(
                $request->get('membershipfee_id'), 
                $asl
            );
            if ($membershipfee instanceof Membershipfee) {
                $dm->getRepository('FdsAslMongoBundle:Membershipfee')
                    ->findAndUpdateMembership($request, $membershipfee);
                
                $this->clearCache();
                $membershipfee = $dm->getRepository('FdsAslMongoBundle:Membershipfee')
                    ->findOneByIdentifier((int) $request->get('membershipfee_id'));
            
                return new Response($serializer->serialize($membershipfee, 'json'));
            } else {
                return $membershipfee;
            }
        } else {
            return $asl;
        }
    }
    
}
