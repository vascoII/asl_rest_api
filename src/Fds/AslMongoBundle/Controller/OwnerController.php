<?php

namespace Fds\AslMongoBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Property;
use Fds\AslMongoBundle\Document\Owner;


/**
 * Owner controller.
 */
class OwnerController extends CommonController
{
    /**
     * @ApiDoc(description="Get Owners List for Asl")
     * 
     * @param Request $request
     * @return owner Collection of an Asl
     */
    public function getOwnersAslAction(Request $request)
    {
        $ownersCollection = new ArrayCollection();
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $properties = $asl->getProperties();
            if (count($properties)) {
                foreach ($properties as $property) {
                    $owners = $property->getOwners();
                    if (count($owners)) {
                        foreach ($owners as $owner) {
                            $ownersCollection[] = $owner;
                        }
                    } else {
                        return $this->notFound(
                            $this->getParameter('constant_owner')
                        );
                    }
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
     * @ApiDoc(description="Get Owners List for Property of Asl")
     * 
     * @param Request $request
     * @return owner Collection of a property
     */
    public function getOwnersPropertyAction(Request $request)
    {
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $owners = $property->getOwners();
                if (count($owners)) {
                    return $this->getRead($owners);
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
    
    /**
     * @ApiDoc(description="Get Owner for Property of Asl")
     * 
     * @param Request $request
     * @return owner Document
     */
    public function getOwnerAction(Request $request)
    {
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
                    return $this->getRead($owner);
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
    
    /**
     * @ApiDoc(description="Create Owner of Property of Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postOwnerAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_owner')
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
                    ->getRepository('FdsAslMongoBundle:Owner')
                    ->createOwner(
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
     * @ApiDoc(description="Delete Owner of Property of Asl - 
     Can remove owner only if no payment done
     otherwise dissociated him to keep track")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function deleteOwnerAction(Request $request)
    { 
        $asl = $this->aslExist($request->get('asl_id'));
        /* @var $asl Asl */
        if ($asl instanceof Asl) {
            $property = $this->propertyExist(
                $request->get('property_id'), 
                $asl
            );
            if ($property instanceof Property) {
                $owner = $this->ownertExist(
                    $request->get('owner_id'), 
                    $asl, 
                    $property
                );
                if ($owner instanceof Owner) {
                    //We keep track of the owner
                    if ($owner->getPayments()) {
                        $this->getDocumentManager()
                            ->getRepository('FdsAslMongoBundle:Owner')
                            ->keepTrackOwner(
                                $owner, 
                                $property, 
                                $request->request->get('endAt')
                            );
                        return $this->patchUpdateModify();
                    } else { // We delete the resident
                        $this->getDocumentManager()
                            ->getRepository('FdsAslMongoBundle:Owner')
                            ->deleteOwner($owner, $property);
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
     * @ApiDoc(description="Update Owner of Property of Asl")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function patchOwnerAction(Request $request)
    {  
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
                        ->getRepository('FdsAslMongoBundle:Owner')
                        ->findAndUpdateOwner($request, $owner);
                    
                    return $this->patchUpdateModify();
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
