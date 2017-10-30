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
     * @FOSRest\View(serializerGroups={"property"})
     */
    public function getPropertyAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
            ->getRepository('FdsAslBundle:Asl')
            ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $criteria = [
            'id' => $request->get('property_id'),
            'asl' => $request->get('asl_id')
        ];
        $property = $this->get('doctrine.orm.entity_manager')
            ->getRepository('FdsAslBundle:Property')
            ->findOneBy($criteria);
        
        if (empty((array) $property)) {
            return $this->propertyNotFound();
        }
        
        return $property;
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
     * @FOSRest\View(statusCode=Response::HTTP_NO_CONTENT,
     *     serializerGroups={"property"}
     *  )
     */
    public function deletePropertyAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $asl = $em->getRepository('FdsAslBundle:Asl')
            ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $criteria = [
            'id' => $request->get('property_id'),
            'asl' => $request->get('asl_id')
        ];
        $property = $em->getRepository('FdsAslBundle:Property')
            ->findOneBy($criteria);
        
        if (empty((array) $property)) {
            return $this->propertyNotFound();
        }

        $em->remove($property);
        $em->flush();
    }

    /**
     * @FOSRest\View(serializerGroups={"property"})
     */
    public function putPropertyAction(Request $request)
    {
        return $this->updateProperty($request, true);
    }

    /**
     * @FOSRest\View(serializerGroups={"property"})
     */
    public function patchPropertyAction(Request $request)
    {
        return $this->updateProperty($request, false);
    }

    private function updateProperty(Request $request, $clearMissing)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $asl = $em->getRepository('FdsAslBundle:Asl')
            ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $criteria = [
            'id' => $request->get('property_id'),
            'asl' => $request->get('asl_id')
        ];
        $property = $em->getRepository('FdsAslBundle:Property')
            ->findOneBy($criteria);
        
        if (empty((array) $property)) {
            return $this->propertyNotFound();
        }
        
        $form = $this->createForm(PropertyType::class, $property);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($property);
            $em->flush();
            return $property;
        } else {
            return $form;
        }
    }
    
    private function aslNotFound()
    {
        return FOSView::create(
            ['message' => 'Asl not found'], 
            Response::HTTP_NOT_FOUND
        );
    }
    
    private function propertyNotFound()
    {
        return FOSView::create(
            ['message' => 'Property not found'], 
            Response::HTTP_NOT_FOUND
        );
    }
}
