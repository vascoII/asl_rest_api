<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslMongoBundle\Document\Resident;
use Fds\AslMongoBundle\Form\ResidentType;

/**
 * Resident controller.
 */
class ResidentController extends CommonController
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
       
}
