<?php

namespace Fds\AslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOSRest; 
use FOS\RestBundle\View\View as FOSView; 
use Fds\AslBundle\Form\Type\MembershipFeeType;
use Fds\AslBundle\Entity\MembershipFee;

class MembershipFeeController extends Controller
{
    /**
     * @FOSRest\View(serializerGroups={"membershipfee"})
     */
    public function getMembershipFeesAction(Request $request)
    {
        $asl = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:Asl')
                ->find($request->get('asl_id'));
        /* @var $asl Asl */

        if (empty((array) $asl)) {
            return $this->aslNotFound();
        }

        return $asl->getMembershipFees();
    }
    
    /**
     * @FOSRest\View(
     *     statusCode=Response::HTTP_CREATED,
     *     serializerGroups={"membershipfee"}
     *  )
     */
    public function postMembershipFeeAction(Request $request)
    {
        $membershipfee = new MembershipFee();
        $form = $this->createForm(MembershipFeeType::class, $membershipfee);

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
    public function putMembershipFeeAction(Request $request)
    {
        return $this->updateMembershipFee($request, true);
    }
    
    /**
     * @FOSRest\View(serializerGroups={"membershipfee"})
     */
    public function patchMembershipFeeAction(Request $request)
    {
        return $this->updateMembershipFee($request, false);
    }
    
    private function updateMembershipFee(Request $request, $clearMissing)
    {
        $membershipfee = $this->get('doctrine.orm.entity_manager')
                ->getRepository('FdsAslBundle:MembershipFee')
                ->find($request->get('membershipfee_id'));
        /* @var $membershipfee MembershipFee */

        if (empty((array) $membershipfee)) {
            return FOSView::create(
                ['message' => 'Membership Fee not found'], 
                Response::HTTP_NOT_FOUND
            );
        }
        
        $form = $this->createForm(MembershipFeeType::class, $membershipfee);

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
