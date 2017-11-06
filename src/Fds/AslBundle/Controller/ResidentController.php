<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; 
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\ResidentType;
use Fds\AslBundle\Entity\Resident;

class ResidentController extends Controller
{
    /**
     * @FOSRest\View(serializerGroups={"resident"})
     */
    public function getResidentsAction(Request $request)
    {
        $residents = [];
        
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->findAll($request->get('asl_id'));
        /* @var $asl Asl */
        
        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $properties = $this->get('doctrine.orm.entity_manager')
            ->getRepository('FdsAslBundle:Property')
            ->findByAsl($request->get('asl_id'));
        
        if (empty((array) $properties)) {
            return $this->propertyNotFound();
        }
        
        foreach($properties as $property){
            $residents[] = $property->getResidents();
        }
        return $residents;
    }
    
    /**
     * @FOSRest\View(serializerGroups={"resident"})
     */
    public function getResidentAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
       
        $criteriaProperty = [
            'id' => $request->get('property_id'),
            'asl' => $request->get('asl_id')
        ];
        $property = $this->get('doctrine.orm.entity_manager')
            ->getRepository('FdsAslBundle:Property')
            ->findOneBy($criteriaProperty);

        if (empty((array) $property)) {
            return $this->propertyNotFound();
        }
        
        return $property;
    }
    
    /**
     * @FOSRest\View(
     *     statusCode=Response::HTTP_CREATED,
     *     serializerGroups={"resident"}
     *  )
     */
    public function postResidentsAction(Request $request)
    {
        $resident = new Resident();
        $form = $this->createForm(ResidentType::class, $resident);

        $form->submit($request->request->all()); 

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($resident);
            $em->flush();
            return $resident;
        } else {
            return $form;
        }
    }
    
    /**
     * @FOSRest\View(statusCode=Response::HTTP_NO_CONTENT,
     *     serializerGroups={"resident"}
     *  )
     */
    public function deleteResidentAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $resident = $em->getRepository('FdsAslBundle:Resident')
                    ->find($request->get('resident_id'));
        /* @var $resident Resident */

        if (!$resident) {
            return;
        }

        if (!empty((array) $resident->getProperties())) {
            return FOSView::create(
                ['message' => 'You can not delete an Resident before updating '
                    . 'his properties data'], 
                Response::HTTP_FORBIDDEN
            );
        }
        $em->remove($resident);
        $em->flush();
    }
    
    /**
     * @FOSRest\View(serializerGroups={"resident"})
     */
    public function putResidentAction(Request $request)
    {
        return $this->updateResident($request, true);
    }
    
    /**
     * @FOSRest\View(serializerGroups={"resident"})
     */
    public function patchResidentAction(Request $request)
    {
        return $this->updateResident($request, false);
    }
    
    private function updateResident(Request $request, $clearMissing)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $asl = $em->getRepository('FdsAslBundle:Asl')
            ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $resident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Resident')
                ->find($request->get('resident_id'));
        /* @var $resident Resident */

        if (empty((array) $asl)) {
            return $this->residentNotFound();
        }
        
        $form = $this->createForm(ResidentType::class, $resident);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($resident);
            $em->flush();
            return $resident;
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
    
    private function residentNotFound()
    {
        return FOSView::create(
            ['message' => 'Resident not found'], 
            Response::HTTP_NOT_FOUND
        );
    }

}
