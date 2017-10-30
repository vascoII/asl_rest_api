<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; 
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\OwnerType;
use Fds\AslBundle\Entity\Owner;

class OwnerController extends Controller
{
    /**
     * @FOSRest\View(serializerGroups={"owner"})
     */
    public function getOwnersAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->findAll($request->get('asl_id'));
        /* @var $asl Asl */
        
        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }

        return $asl->getOwners();
    }
    
    /**
     * @FOSRest\View(serializerGroups={"owner"})
     */
    public function getOwnerAction(Request $request)
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
     *     serializerGroups={"owner"}
     *  )
     */
    public function postOwnersAction(Request $request)
    {
        $owner = new Owner();
        $form = $this->createForm(OwnerType::class, $owner);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($owner);
            $em->flush();
            return $owner;
        } else {
            return $form;
        }
    }
    
    /**
     * @FOSRest\View(statusCode=Response::HTTP_NO_CONTENT,
     *     serializerGroups={"owner"}
     *  )
     */
    public function deleteOwnerAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $owner = $em->getRepository('FdsAslBundle:Owner')
                    ->find($request->get('owner_id'));
        /* @var $owner Owner */

        if (!$owner) {
            return;
        }

        if (!empty((array) $owner->getProperties())) {
            return FOSView::create(
                ['message' => 'You can not delete an Owner before updating '
                    . 'his properties data'], 
                Response::HTTP_FORBIDDEN
            );
        }
        $em->remove($owner);
        $em->flush();
    }
    
    /**
     * @FOSRest\View(serializerGroups={"owner"})
     */
    public function putOwnerAction(Request $request)
    {
        return $this->updateOwner($request, true);
    }
    
    /**
     * @FOSRest\View(serializerGroups={"owner"})
     */
    public function patchOwnerAction(Request $request)
    {
        return $this->updateOwner($request, false);
    }
    
    private function updateOwner(Request $request, $clearMissing)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $asl = $em->getRepository('FdsAslBundle:Asl')
            ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }
        
        $owner = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Owner')
                ->find($request->get('owner_id'));
        /* @var $owner Owner */

        if (empty((array) $asl)) {
            return $this->ownerNotFound();
        }
        
        $form = $this->createForm(OwnerType::class, $owner);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($owner);
            $em->flush();
            return $owner;
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
    
    private function ownerNotFound()
    {
        return FOSView::create(
            ['message' => 'Owner not found'], 
            Response::HTTP_NOT_FOUND
        );
    }

}
