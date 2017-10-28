<?php

namespace Fds\AslBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Fds\AslBundle\Entity\Asl;

class AslController extends Controller
{
    /**
     * @Method({"GET"})
     */
    public function getAslsAction(Request $request)
    {
        return new JsonResponse([
            new Asl("La Marniere", "Rue du pic-vert", "95490", "Vaureal", "France"),
        ]);
    }

}
