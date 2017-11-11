<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fds\AslMongoBundle\Document\Resident;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * Resident controller.
 */
class ResidentController extends CommonController
{
    /**
     * @FOSRest\View(serializerGroups={"residents"})
     */
    public function getResidentsAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $dm = $this->getDocumentManager();
        
        $asl = $dm
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));

        if ($asl) {
            $criteria = [
                'identifier' => (int) $request->get('property_id'),
                'asl' => $asl
            ];
            $property = $dm->getRepository('FdsAslMongoBundle:Property')
                ->findOneBy($criteria);

            if ($property) {
                $residents = $property->getResidents();
                if (count($residents)) {
                    return new Response($serializer->serialize($residents, 'json'));
                } else { 
                    return $this->noDocumentFound(
                        $this->getParameter('constant_resident')
                    );
                }
            } else {
                return $this->noDocumentFound(
                    $this->getParameter('constant_property')
                );
            } 
        } else {
            return $this->noDocumentFound($this->getParameter('constant_asl'));
        }
    }
    
    /**
     * @FOSRest\View(serializerGroups={"resident"})
     */
    public function getResidentAction(Request $request)
    {
        $serializer = $this->get('jms_serializer'); 
        $dm = $this->getDocumentManager();
        
        $asl = $dm
            ->getRepository('FdsAslMongoBundle:Asl')
            ->findOneByIdentifier((int) $request->get('asl_id'));

        if ($asl) {
            $criteria = [
                'identifier' => (int) $request->get('property_id'),
                'asl' => $asl
            ];
            $property = $dm->getRepository('FdsAslMongoBundle:Property')
                ->findOneBy($criteria);

            if ($property) {
                $residents = $property->getResidents();
                foreach ($residents as $resident) {
                    if (
                        (int) $resident->getIdentifier() == 
                        (int) $request->get('resident_id')
                    ) {
                        return new Response(
                            $serializer->serialize($resident, 'json')
                        );
                    }
                }

                return $this->noDocumentFound(
                    $this->getParameter('constant_resident')
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
    
    public function postResidentAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $resident = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Resident')
            ->createResident(
                $request->request, 
                $this->getIdPlusOneAdded(
                    $this->getParameter('constant_resident')
                ),
                (int) $request->get('asl_id'),
                (int) $request->get('property_id'),
                $this->noDocumentFound($this->getParameter('constant_asl')),
                $this->noDocumentFound($this->getParameter('constant_property'))
            );            
        
        return new Response($serializer->serialize($resident, 'json'));
    }
    
    /**
     * 
     * @param Request $request
     * @return Response
     * 
     * Can remove resident or dissociated him to keep track
     */
    public function deleteResidentAction(Request $request)
    { 
        $keepTrack = $request->request->get('keepTrack');
        //We keep track of the resident
        if ($keepTrack) {
            $resident = $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Resident')
                ->keepTrackResident(
                    $request,    
                    $this->noDocumentFound($this->getParameter('constant_asl')),
                    $this->noDocumentFound($this->getParameter('constant_property')),
                    $this->noDocumentFound($this->getParameter('constant_resident')),
                    $this->documentTracked('Resident')
                );
        } else { // We delete the resident
            $resident = $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Resident')
                ->deleteResident(
                    $request,    
                    $this->noDocumentFound($this->getParameter('constant_asl')),
                    $this->noDocumentFound($this->getParameter('constant_property')),
                    $this->noDocumentFound($this->getParameter('constant_resident')),
                    $this->documentRemoved('Resident')
                );
        }
        return $resident;
    }
    
    public function patchResidentAction(Request $request)
    {  
        $resident = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Resident')
            ->findAndUpdateResident(
                $request,    
                $this->noDocumentFound($this->getParameter('constant_asl')),
                $this->noDocumentFound($this->getParameter('constant_property')),
                $this->noDocumentFound($this->getParameter('constant_resident')),
                $this->documentTracked('Resident')
            );   
        return $resident;
    }
}
