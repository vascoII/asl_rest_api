<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslMongoBundle\Document\Property;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * Property controller.
 */
class PropertyController extends CommonController
{
    /**
     * @FOSRest\View(serializerGroups={"properties"})
     */
    public function getPropertiesAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $asl = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));

        if ($asl) {
            $properties = $asl->getProperties();
            if (count($properties)) {
                return new Response($serializer->serialize($properties, 'json'));
            } else {
                return $this->noDocumentFound(
                    $this->getParameter('constant_property')
                );
            }
        } else {
            return $this->noDocumentFound($this->getParameter('constant_property'));
        }
    }
    
    public function getPropertyAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $dm = $this->getDocumentManager();
        
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));

        if ($asl) {          
            $properties = $asl->getProperties();
            foreach ($properties as $property) {
                if (
                    (int) $property->getIdentifier() == 
                    (int) $request->get('property_id')
                ) {
                    return new Response(
                        $serializer->serialize($property, 'json')
                    );
                }
            }
                
            return $this->noDocumentFound(
                $this->getParameter('constant_property')
            );
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
    public function postPropertyAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $property = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Property')
            ->createProperty(
                $request->request, 
                $this->getIdPlusOneAdded(
                    $this->getParameter('constant_property')
                ),
                (int) $request->get('asl_id'),
                $this->noDocumentFound($this->getParameter('constant_property'))
            );            
        
        return new Response($serializer->serialize($property, 'json'));
    }
    
    public function deletePropertyAction(Request $request)
    { 
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        
        if ($asl) {
            $criteria = [
                'identifier' => (int) $request->get('property_id'),
                'asl' => $asl
            ];
            $property = $dm->getRepository('FdsAslMongoBundle:Property')
                ->findOneBy($criteria);

            if ($property) {
                $propertyNumber = $property->getNumber();
                $propertyOwners = $property->getOwners(); 
                $propertyResidents = $property->getResidents();
                //Remove Property only if no residents and owners related
                if (
                    (!count($propertyOwners)) &&
                    (!count($propertyResidents))     
                ) {
                    $dm->remove($property);
                    $dm->flush();
                    return $this->documentRemoved('Property N°:'.$propertyNumber);
                } else {
                    return $this->documentRemoveNotAllowed(
                        'Property N°:'.$propertyNumber, 
                        $this->getParameter('constant_own_or_pro') 
                    );
                }
            } else {
                return $this->noDocumentFound($this->getParameter('property_asl'));
            }
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
        $property = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Property')
            ->deleteProperty(
                (int) $request->get('asl_id'),
                (int) $request->get('property_id'),
                $this->noDocumentFound($this->getParameter('constant_asl')),
                $this->noDocumentFound($this->getParameter('constant_property')),
                $this->documentRemoved('Property')
            );
          
        return $property;
    }
    
    public function patchPropertyAction(Request $request)
    {  
        $serializer = $this->get('jms_serializer');
        
        $dm = $this->getDocumentManager();
        $asl = $dm->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));
        
        if ($asl) {
            $property = $dm->getRepository('FdsAslMongoBundle:Property')
                ->findOneByIdentifier((int) $request->get('property_id'));
            
            if ($property) {
                $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Property')
                    ->findAndUpdateProperty($request->request, $property);            

                $property = 
                    $dm->getRepository('FdsAslMongoBundle:Property')
                        ->findOneByIdentifier(
                            (int) $request->get('property_id')
                        );
                return new Response(
                    $serializer->serialize($property, 'json')
                );
            } else {
                return $this->noDocumentFound(
                    $this->getParameter('constant_property')
                );
            }
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
}
