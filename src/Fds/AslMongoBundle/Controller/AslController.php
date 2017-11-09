<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Form\AslType;

/**
 * Asl controller.
 */
class AslController extends Controller
{
    public function getAslsAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $asls = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findAll();

        if (!$asls) {
            return $this->noDocumentFound();
        }
        
        return new Response($serializer->serialize($asls, 'json'));
    }
    
    public function getAslAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier($request->get('asl_id'));
        /* @var $asl Asl */
        if (!$asl) {
            return $this->noDocumentFound();
        }
        
        return new Response($serializer->serialize($asl, 'json'));
    }
    
    public function postAslAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $resident = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->createAsl($request->request, $this->getIdPlusOneAdded());            
        
        return new Response($serializer->serialize($resident, 'json'));
    }
    
    /**
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
    
    /*
     * @return integer last document identifier + one
     */
    private function getIdPlusOneAdded()
    {
        $mongoService = 
            $this->container->get('fds_mongoservice.getidplusoneadded');
        return $mongoService->getIdPlusOneAdded('Asl');
    }
    
    /**
     * @return FOSView 
     */
    private function noDocumentFound()
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.nodocumentfound');
        return $fosviewService->noDocumentFound('Asl');
    }
}
