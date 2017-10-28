<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Fds\AslBundle\Entity\Asl;

class AslController extends Controller
{
    /**
     * @Rest\View()
     */
    public function getAslsAction(Request $request)
    {
        $asls = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->findAll();
        /* @var $asls Asl[] */

        return $asls;
    }
    
    /**
     * @Rest\View()
     */
    public function getAslAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return new JsonResponse(
                ['message' => 'Asl not found'], 
                Response::HTTP_NOT_FOUND
            );
        }
        
        return $asl;
    }

}
