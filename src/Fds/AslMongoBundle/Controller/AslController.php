<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Form\AslType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Asl controller.
 */
class AslController extends Controller
{
    public function getAslsAction(Request $request)
    {
        $asls = $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Asl')
                ->findAll();
        /* @var $asls Asl[] */
        
        return new JsonResponse($asls);
    }
    
    /**
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
