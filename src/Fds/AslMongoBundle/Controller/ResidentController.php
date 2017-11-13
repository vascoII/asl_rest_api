<?php

namespace Fds\AslMongoBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Property;
use Fds\AslMongoBundle\Document\Resident;


/**
 * Resident controller.
 */
class ResidentController extends CommonController
{
    /**
     * @ApiDoc(description="Get Residents List of Asl")
     * 
     * @param Request $request
     * @return resident Collection
     */
    public function getResidentsAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $residents = $property->getResidents();
                if (count($residents)) {
                    return $this->getRead($residents);
                } else { 
                    return $this->notFound(
                        $this->getParameter('constant_resident')
                    );
                }
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
     * @ApiDoc(description="Get Property of Asl")
     * 
     * @param Request $request
     * @return resident Document
     */
    public function getResidentAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $resident = $this->residentExist(
                    $request->get('resident_id'), 
                    $asl, 
                    $property
                );
                if ($resident instanceof Resident) {
                    return $this->getRead($resident);
                } else {
                    return $this->notFound(
                        $this->getParameter('constant_resident')
                    );
                }
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
     * @ApiDoc(description="Create Property of Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postResidentAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_resident')
        );
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $this->getDocumentManager()
                    ->getRepository('FdsAslMongoBundle:Resident')
                    ->createResident(
                        $request, 
                        $getIdPlusOneAdded, 
                        $asl, 
                        $property
                    );            
                return $this->postCreate($request->getUri().'/'.$getIdPlusOneAdded);
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
     * @ApiDoc(description="Delete or Archive Resident of Asl")
     * 
     * @param Request $request
     * @return FOSView
     *
     */
    public function deleteResidentAction(Request $request)
    { 
        $keepTrack = $request->request->get('keepTrack');
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $resident = $this->residentExist(
                    $request->get('resident_id'), 
                    $asl, 
                    $property
                );
                if ($resident instanceof Resident) {
                    //We keep track of the resident
                    if ($keepTrack) {
                        $this->getDocumentManager()
                            ->getRepository('FdsAslMongoBundle:Resident')
                            ->keepTrackResident(
                                $resident, 
                                $property, 
                                $request->request->get('endAt')
                            );
                        return $this->patchUpdateModify();
                    } else { // We delete the resident
                        $this->getDocumentManager()
                            ->getRepository('FdsAslMongoBundle:Resident')
                            ->deleteResident($resident, $property);
                        return $this->deleteDelete();
                    }
                } else {
                    return $this->notFound(
                        $this->getParameter('constant_resident')
                    );
                }
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
     * @ApiDoc(description="Update Resident of Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function patchResidentAction(Request $request)
    {  
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $resident = $this->residentExist(
                    $request->get('resident_id'), 
                    $asl, 
                    $property
                );
                if ($resident instanceof Resident) {
                    $this->getDocumentManager()
                        ->getRepository('FdsAslMongoBundle:Resident')
                        ->findAndUpdateResident($request, $resident);
                    
                    return $this->patchUpdateModify();
                } else {
                    return $this->notFound(
                        $this->getParameter('constant_resident')
                    );
                }
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
