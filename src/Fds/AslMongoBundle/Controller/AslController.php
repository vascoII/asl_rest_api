<?php

namespace Fds\AslMongoBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

use Fds\AslMongoBundle\Document\Asl;

/**
 * Asl controller.
 */
class AslController extends CommonController
{
    /**
     * @ApiDoc(description="Get Asls List")
     * 
     * @return Asl Collection
     */
    public function getAslsAction()
    { 
        $asls = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findAll();

        if (!$asls) {
            return $this->notFound($this->getParameter('constant_asl'));
        }
        return $this->getRead($asls);
    }
    
    /**
     * @ApiDoc(description="Get Asl")
     * 
     * @param Request $request
     * @return Asl Document
     */
    public function getAslAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            return $this->getRead($asl);
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @ApiDoc(description="Create Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postAslAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_asl')
        );
        $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->createAsl($request, $getIdPlusOneAdded);            
        
        return $this->postCreate($request->getUri().'/'.$getIdPlusOneAdded);
    }
    
    /**
     * @ApiDoc(description="Delete Asl only if no Membershipfee or Property related")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function deleteAslAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $aslName = $asl->getName();
            $aslMembershipfees = $asl->getMembershipfees(); 
            $aslProperties = $asl->getProperties();
            //Remove Asl only if no membershipfees and properties related
            if (
               (!count($aslMembershipfees)) &&
               (!count($aslProperties))     
            ) {
                $this->getDocumentManager()->remove($asl);
                $this->getDocumentManager()->flush();
                return $this->deleteDelete();
            } else {
                return $this->conflict(
                    "$aslName can not be removed : Remove " .
                    $this->getParameter('constant_mem_or_pro') .
                    " before."
                );
            }
        }  else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @ApiDoc(description="Update Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function patchAslAction(Request $request)
    {  
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Asl')
                ->findAndUpdateAsl($request->request, $asl);            

            return $this->patchUpdateModify();
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
}
