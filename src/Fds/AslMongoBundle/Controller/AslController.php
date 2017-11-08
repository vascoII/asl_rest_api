<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslMongoBundle\Form\Type\AslType;
use Fds\AslMongoBundle\Form\Type\MembershipfeeType;
use Fds\AslMongoBundle\Form\Type\OwnerType;
use Fds\AslMongoBundle\Form\Type\PaymentType;
use Fds\AslMongoBundle\Form\Type\PropertyType;
use Fds\AslMongoBundle\Form\Type\ResidentType;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Membershipfee;
use Fds\AslMongoBundle\Document\Owner;
use Fds\AslMongoBundle\Document\Payment;
use Fds\AslMongoBundle\Document\Property;
use Fds\AslMongoBundle\Document\Resident;

class AslController extends Controller
{
    public function getAslsAction(Request $request)
    {
        $asls = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->findAll();
        /* @var $asls Asl[] */

        return $asls;
    }
    
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
        return $asl;
    }
    
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
    
    public function putAslAction(Request $request)
    {
        return $this->updateAsl($request, true);
    }
    
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
