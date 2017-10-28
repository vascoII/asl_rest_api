<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; // alias pour toutes les annotations
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\AslType;
use Fds\AslBundle\Entity\Asl;

class AslController extends Controller
{
    /**
     * @FOSRest\View()
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
     * @FOSRest\View()
     */
    public function getAslAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return FOSView::create(
                ['message' => 'Asl not found'], 
                Response::HTTP_NOT_FOUND
            );
        }
        
        return $asl;
    }
    
    /**
     * @FOSRest\View()
     */
    public function postAslsAction(Request $request)
    {
        $asl = new Asl();
        $form = $this->createForm(AslType::class, $asl);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($asl);
            $em->flush();
            return $asl;
        } else {
            return $form;
        }
    }
    
    /**
     * @FOSRest\View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deleteAslAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $asl = $em->getRepository('FdsAslBundle:Asl')
                    ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if ($asl) {
            $em->remove($asl);
            $em->flush();
        }
    }
    
    /**
     * @FOSRest\View()
     */
    public function putAslAction(Request $request)
    {
        return $this->updateAsl($request, true);
    }
    
    /**
     * @FOSRest\View()
     */
    public function patchAslAction(Request $request)
    {
        return $this->updateAsl($request, false);
    }
    
    private function updateAsl(Request $request, $clearMissing)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return FOSView::create(
                ['message' => 'Asl not found'], 
                Response::HTTP_NOT_FOUND
            );
        }
        
        $form = $this->createForm(AslType::class, $asl);

        $form->submit($request->request->all(), $clearMissing); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($asl);
            $em->flush();
            return $asl;
        } else {
            return $form;
        }
    }

}
