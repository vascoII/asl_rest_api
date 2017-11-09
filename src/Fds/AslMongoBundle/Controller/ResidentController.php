<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Resident;
use Fds\AslMongoBundle\Form\ResidentType;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View as FOSView;

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
            return FOSView::create(
                ['message' => 'No residents found'], 
                Response::HTTP_NOT_FOUND
            );
        }
        
        return new Response($serializer->serialize($residents, 'json'));
    }
    
    public function postResidentsAction(Request $request)
    {
        $resident = new Resident();
        $resident->setFirstName('Fabrice');
        $resident->setLastName('Da Silva');
        $resident->setEmail('fds@yahoo.fr');
        $resident->setCreatedAt(new \DateTime());
        
        $dm = $this->getDocumentManager();
        $dm->persist($resident);
        $dm->flush();
            
        return new JsonResponse($resident);
    }
    
    /**
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
