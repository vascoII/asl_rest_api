<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Property;

/**
 * Property controller.
 */
class PropertyController extends CommonController
{
    /**
     * @param Request $request
     * @return property Collection
     */
    public function getPropertiesAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $properties = $asl->getProperties();
            if (count($properties)) {
                return $this->getRead($properties);
            } else {
                return $this->notFound(
                    $this->getParameter('constant_property')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @param Request $request
     * @return property Document
     */
    public function getPropertyAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                return $this->getRead($property);
            } else {
                return $this->notFound(
                    $this->getParameter('constant_membershipfee')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @param Request $request
     * @return FOSView
     */
    public function postPropertyAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_membershipfee')
        );
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Property')
                ->createProperty($request, $getIdPlusOneAdded, $asl);            
        
            return $this->postCreate($request->getUri().'/'.$getIdPlusOneAdded);
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @param Request $request
     * @return FOSView
     */
    public function deletePropertyAction(Request $request)
    { 
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $propertyNumber = $property->getNumber();
                $propertyOwners = $property->getOwners(); 
                $propertyResidents = $property->getResidents();
                //Remove Property only if no residents and owners related
                if (
                    (!count($propertyOwners)) &&
                    (!count($propertyResidents))     
                ) {
                    $this->getDocumentManager()->remove($property);
                    $this->getDocumentManager()->flush();
                    return $this->deleteDelete();
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
    }
    
    /**
     * @param Request $request
     * @return FOSView
     */
    public function patchPropertyAction(Request $request)
    {  
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Property')
                    ->findAndUpdateProperty($request->request, $property);            

                return $this->patchUpdateModify();
            } else {
                return $this->notFound(
                    $this->getParameter('constant_property')
                );
            }
        } else {
            return $this->notFound($this->getParameter('constant_asl'));
        }
    }
    
}
