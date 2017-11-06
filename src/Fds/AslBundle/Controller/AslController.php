<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; 
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\AslType;
use Fds\AslBundle\Entity\Asl;

class AslController extends Controller
{
    /**
     * @FOSRest\View(serializerGroups={"asls"})
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
     * @FOSRest\View(serializerGroups={"asl"})
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
        /**
         * Return 
         * {
            "asl_properties",
            "properties",
                "owners",
                "residents"
            "membershipfees"
         */
        return $asl;
    }
    
    /**
     * @FOSRest\View(
     *     statusCode=Response::HTTP_CREATED,
     *     serializerGroups={"asl"}
     *  )
     */
    public function postAslsAction(Request $request)
    {
        $asl = new Asl();
        $form = $this->createForm(AslType::class, $asl);

        $form->submit($request->request->all()); 

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
     * @FOSRest\View(statusCode=Response::HTTP_NO_CONTENT,
     *     serializerGroups={"asl"}
     *  )
     */
    public function deleteAslAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $asl = $em->getRepository('FdsAslBundle:Asl')
                    ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return FOSView::create(
                ['message' => 'Asl not found'], 
                Response::HTTP_NOT_FOUND
            );
        }

        foreach ($asl->getProperties() as $property) {
            $em->remove($property);
        }
        $em->remove($asl);
        $em->flush();
    }
    
    /**
     * @FOSRest\View(serializerGroups={"asl"})
     */
    public function putAslAction(Request $request)
    {
        return $this->updateAsl($request, true);
    }
    
    /**
     * @FOSRest\View(serializerGroups={"asl"})
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

        $form->submit($request->request->all(), $clearMissing);

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
