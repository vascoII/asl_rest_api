<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; 
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\PropertyType;
use Fds\AslBundle\Entity\Property;

class PropertyController extends Controller
{
    /**
     * @FOSRest\View(serializerGroups={"property"})
     */
    public function getPropertiesAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }

        return $asl->getProperties();
    }

    /**
     * @FOSRest\View()
     */
    public function getPropertyAction(Request $request)
    {
          
    }

    /**
     * @FOSRest\View(statusCode=Response::HTTP_CREATED, 
     *  serializerGroups={"property"})
     */
    public function postPropertiesAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $property = new Property();
        $property->setAsl($asl); 
        $form = $this->createForm(PropertyType::class, $property);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($property);
            $em->flush();
            return $property;
        } else {
            return $form;
        }
    }
    
    /**
     * @FOSRest\View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deletePropertyAction(Request $request)
    {
        
    }

    /**
     * @FOSRest\View()
     */
    public function putPropertyAction(Request $request)
    {
        return $this->updateProperty($request, true);
    }

    /**
     * @FOSRest\View()
     */
    public function patchPropertyAction(Request $request)
    {
        return $this->updateProperty($request, true);
    }

    private function updateProperty(Request $request, $clearMissing)
    {
        
    }
    
    private function aslNotFound()
    {
        return FOSView::create(
            ['message' => 'Asl not found'], 
            Response::HTTP_NOT_FOUND
        );
    }
}
