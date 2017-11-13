<?php

namespace Fds\AslMongoBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Property;
use Fds\AslMongoBundle\Document\Owner;
use Fds\AslMongoBundle\Document\Payment;


/**
 * Payment controller.
 */
class PaymentController extends CommonController
{
    /**
     * @ApiDoc(description="Create Payment by Owner for Membershipfees")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postPaymentsAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_payment')
        );
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $owner = $this->ownerExist(
                    $request->get('owner_id'), 
                    $asl, 
                    $property
                );
                if ($owner instanceof Owner) {
                    $this->getDocumentManager()
                        ->getRepository('FdsAslMongoBundle:Payment')
                        ->createPayment(
                            $request, 
                            $getIdPlusOneAdded, 
                            $asl, 
                            $property,
                            $owner
                        );            
                    return $this->postCreate($request->getUri().'/'.$getIdPlusOneAdded);
                } else {
                    return $this->notFound(
                        $this->getParameter('constant_owner')
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
