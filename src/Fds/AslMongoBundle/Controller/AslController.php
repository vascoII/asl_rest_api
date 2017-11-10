<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Form\AslType;

/**
 * Asl controller.
 */
class AslController extends CommonController
{
    const ASL = 'Asl';
    
    public function getAslsAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $asls = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findAll();

        if (!$asls) {
            return $this->noDocumentFound(self::ASL);
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
            return $this->noDocumentFound(self::ASL);
        }
        
        return new Response($serializer->serialize($asl, 'json'));
    }
    
    public function postAslAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->createAsl($request->request, $this->getIdPlusOneAdded(self::ASL));            
        
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
            return $this->noDocumentFound(self::ASL);
        }
    }
    
}
