<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; 
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\MembershipfeeType;
use Fds\AslBundle\Entity\Membershipfee;

class MembershipfeeController extends Controller
{
    /**
     * @FOSRest\View(serializerGroups={"membershipfee"})
     */
    public function getMembershipfeesAction(Request $request)
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
        
        return $asl->getMembershipfees();
    }
    
    /**
     * @FOSRest\View(
     *     statusCode=Response::HTTP_CREATED,
     *     serializerGroups={"membershipfee"}
     *  )
     */
    public function postMembershipfeeAction(Request $request)
    {
        $membershipfee = new Membershipfee();
        $form = $this->createForm(MembershipfeeType::class, $membershipfee);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($membershipfee);
            $em->flush();
            return $membershipfee;
        } else {
            return $form;
        }
    }
    
    /**
     * @FOSRest\View(serializerGroups={"membershipfee"})
     */
    public function putMembershipfeeAction(Request $request)
    {
        return $this->updateMembershipfee($request, true);
    }
    
    /**
     * @FOSRest\View(serializerGroups={"membershipfee"})
     */
    public function patchMembershipfeeAction(Request $request)
    {
        return $this->updateMembershipfee($request, false);
    }
    
    private function updateMembershipfee(Request $request, $clearMissing)
    {
        $membershipfee = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Membershipfee')
                ->find($request->get('membershipfee_id'));
        /* @var $membershipfee MembershipFee */

        if (empty((array) $membershipfee)) {
            return FOSView::create(
                ['message' => 'Membership Fee not found'], 
                Response::HTTP_NOT_FOUND
            );
        }
        
        $form = $this->createForm(MembershipfeeType::class, $membershipfee);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($membershipfee);
            $em->flush();
            return $membershipfee;
        } else {
            return $form;
        }
    }

}
