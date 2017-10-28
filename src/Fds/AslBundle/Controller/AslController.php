<?php

namespace Fds\AslBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslBundle\Entity\Asl;

class AslController extends Controller
{
    /**
     * @Method({"GET"})
     */
    public function getAslsAction(Request $request)
    {
        $asls = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->findAll();
        /* @var $asls Asl[] */

        $formatted = [];
        foreach ($asls as $asl) {
            $formatted[] = [
               'id' => $asl->getId(),
               'name' => $asl->getName(),
               'address' => $asl->getAddress(),
               'postalCode' => $asl->getPostalCode(),
               'city' => $asl->getCity(),
               'country' => $asl->getCountry(),
            ];
        }

        return new JsonResponse($formatted);
    }
    
    /**
     * @Method({"GET"})
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
        
        $formatted = [
            'id' => $asl->getId(),
            'name' => $asl->getName(),
            'address' => $asl->getAddress(),
            'postalCode' => $asl->getPostalCode(),
            'city' => $asl->getCity(),
            'country' => $asl->getCountry(),
        ];

        return new JsonResponse($formatted);
    }

}
