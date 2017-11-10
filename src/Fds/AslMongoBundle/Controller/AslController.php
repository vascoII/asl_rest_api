<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        /* @var $asl Asl */
        if (!$asl) {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
        
        return new Response($serializer->serialize($asl, 'json'));
    }
    
    public function postAslAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->createAsl(
                $request->request, 
                $this->getIdPlusOneAdded($this->getParameter('constant_asl'))
            );            
        
        return new Response($serializer->serialize($asl, 'json'));
    }
    
    public function deleteAslAction(Request $request)
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
    
    public function patchAslAction(Request $request)
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
