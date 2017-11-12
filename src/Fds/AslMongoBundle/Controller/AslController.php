<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View as FOSView;
use Fds\AslMongoBundle\Document\Asl;

/**
 * Asl controller.
 */
class AslController extends CommonController
{
    public function getAslsAction(Request $request)
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
    
    public function getAslAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            return new Response($serializer->serialize($asl, 'json'));
        } else {
            return $asl;
        }
    }
    
    public function postAslAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_asl')
        );
        $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->createAsl($request, $getIdPlusOneAdded);            
        
        $response = new Response();
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->headers->set(
            'Location', 
            $request->getUri().'/'.$getIdPlusOneAdded
        );
        return $response;
    }
    
    public function deleteAslAction(Request $request)
    {
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        
        if ($asl) {
            $aslName = $asl->getName();
            $aslMembershipfees = $asl->getMembershipfees(); 
            $aslProperties = $asl->getProperties();
            //Remove Asl only if no membershipfees and properties related
            if (
               (!count($aslMembershipfees)) &&
               (!count($aslProperties))     
            ) {
                $dm->remove($asl);
                $dm->flush();
                return $this->documentRemoved($aslName);
            } else {
                return $this->documentRemoveNotAllowed(
                    $aslName, 
                    $this->getParameter('constant_mem_or_pro') 
                );
            }
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
    public function patchAslAction(Request $request)
    {  
        $serializer = $this->get('jms_serializer');
        
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        
        if ($asl) {
            $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Asl')
                ->findAndUpdateAsl($request->request, $asl);            

            $this->clearCache();
            $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
                ->findOneByIdentifier((int) $request->get('asl_id'));
            
            return new Response($serializer->serialize($asl, 'json'));
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
}
