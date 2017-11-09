<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Membershipfee;
use Fds\AslMongoBundle\Form\MembershipfeeType;

/**
 * Membershipfee controller.
 */
class MembershipfeeController extends Controller
{
    public function postMembershipfeeAction(Request $request)
    {
        $membershipfee = new Membershipfee();
        $membershipfee->setYear('2017-01-01');
        $membershipfee->setFee(300.00);
        $membershipfee->setCreatedAt(new DateTime());
        
        $dm = $this->getDocumentManager();
        $dm->persist($membershipfee);
        $dm->flush();
            
        return new JsonResponse($membershipfee);
    }
    
    /**
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
