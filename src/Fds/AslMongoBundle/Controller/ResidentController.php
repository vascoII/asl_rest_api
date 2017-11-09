<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Resident;
use Fds\AslMongoBundle\Form\ResidentType;

/**
 * Resident controller.
 */
class ResidentController extends Controller
{
    public function getResidentsAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $residents = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Resident')
            ->findAll();

        if (!$residents) {
            return $this->noDocumentFound();
        }
        
        return new Response($serializer->serialize($residents, 'json'));
    }
    
    public function postResidentAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $resident = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Resident')
            ->createResident($request->request, $this->getIdPlusOneAdded());            
        
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
        return $mongoService->getIdPlusOneAdded('Resident');
    }
    
    /**
     * @return FOSView 
     */
    private function noDocumentFound()
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.nodocumentfound');
        return $fosviewService->noDocumentFound('Resident');
    }
    
}
