<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; // alias pour toutes les annotations
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

        if (empty($asl)) {
            return $this->placeNotFound();
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
     * @FOSRest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"property"})
     */
    public function postPropertiesAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty($asl)) {
            return $this->placeNotFound();
        }
        
        $property = new Property();
        $property->setAsl($asl); // Ici, l asl est associée aux proprietes
        $form = $this->createForm(PropertyType::class, $property);

        // Le paramétre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
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
    
    private function placeNotFound()
    {
        return FOSView::create(
            ['message' => 'Place not found'], 
            Response::HTTP_NOT_FOUND
        );
    }

}
