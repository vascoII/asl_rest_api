<?php

namespace Fds\AslMongoBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Membershipfee;

/**
 * Membershipfee controller.
 */
class MembershipfeeController extends CommonController
{
    /**
     * @ApiDoc(description="Get Membershipfees List of Asl")
     * 
     * @param Request $request
     * @return membershipfee Collection
     */
    public function getMembershipfeesAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $membershipfees = $asl->getMembershipfees();
            if (count($membershipfees)) {
                return $this->getRead($membershipfees);
            } else {
                return $this->notFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @ApiDoc(description="Get Membershipfee of Asl")
     * 
     * @param Request $request
     * @return membershipfee Document
     */
    public function getMembershipfeeAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $membershipfee = $this->membershipfeeExist(
                $request->get('membershipfee_id'), 
                $asl
            );
            if ($membershipfee instanceof Membershipfee) {
                return $this->getRead($membershipfee);
            } else {
                return $this->notFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @ApiDoc(description="Create Membershipfee for Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
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
                ->createMembershipfee($request, $getIdPlusOneAdded, $asl);            
        
            return $this->postCreate($request->getUri().'/'.$getIdPlusOneAdded);
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @ApiDoc(description="Delete Membershipfee for Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
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
                $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Membershipfee')
                    ->deleteMembershipfee(
                        (int) $request->get('membershipfee_id'),
                        $asl
                    );
                return $this->documentRemoved('Membershipfee');
            } else {
                return $this->notFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @ApiDoc(description="Update Membershipfee for Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function patchMembershipfeeAction(Request $request)
    {  
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $membershipfee = $this->membershipfeeExist(
                $request->get('membershipfee_id'), 
                $asl
            );
            if ($membershipfee instanceof Membershipfee) {
                $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Membershipfee')
                    ->findAndUpdateMembershipfee($request, $membershipfee);
                
                return $this->patchUpdateModify();
            } else {
                return $this->notFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
}
