<?php

namespace Fds\AslMongoBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

use Fds\AslMongoBundle\Document\User;
use Fds\AslMongoBundle\Document\Asl;
use Fds\AslMongoBundle\Document\Owner;

class UserController extends CommonController
{
    const MAMAGER_ROLE = 'Manager';
    /**
     * @ApiDoc(description="Create manager and Viewer(Owner)")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postUserAction(Request $request)
    {
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_user')
        );
        switch ($this->userExist($request)) { 
            case 'bad_Asl': 
                return $this->notFound($this->getParameter('constant_asl'));
                break;
            case 'viewerExist':
                return $this->conflict('This Viewer is already registered');
                break;
            case 'viewer': 
                $asl = $this->aslExist($request->get('asl_id')); 
                if ($asl instanceof Asl) { 
                    return $this->postCreateViewer($request, $asl);
                }
                break;
            case 'managerExist':
                return $this->conflict(
                    'This ' . 
                    $request->request->get('role') . 
                    ' is already registered'
                );
                break;
            case 'manager':
                return $this->postCreateManager($request, $getIdPlusOneAdded);
                break;
        }
    }

    
    private function postCreateViewer($request, $asl)
    { 
        $criteria = [
            'email' => $request->request->get('email'),
            'asl' => $asl,
        ];
        $owner = $this->getDocumentManager()
            ->getRepository('FdsAslMongoBundle:Owner')
            ->findOneBy($criteria); 

        if ($owner instanceof Owner) {
            $viewer = new User();
            $encoder = $this->get('security.password_encoder');
            // le mot de passe en claire est encodé avant la sauvegarde
            $encoded = $encoder->encodePassword(
                $viewer, 
                $request->request->get('plainPassword')
            );
            
            $owner->setPassword($encoded);
            $owner->setUser(true);
            
            $dm = $this->getDocumentManager();
            $dm->persist($owner);
            $dm->flush();
            
            return $this->createUser([
                'email' => $request->request->get('email'),
                'plainPassword' => $request->request->get('plainPassword')
            ]);                
        } else {
            return $this->notFound(
                $this->getParameter('constant_owner')
            );
        }
    }
    
    private function postCreateManager($request, $identifier)
    {
        $manager = new User();
        $encoder = $this->get('security.password_encoder');
        // le mot de passe en claire est encodé avant la sauvegarde
        $encoded = $encoder->encodePassword(
            $manager, 
            $request->request->get('plainPassword')
        );
        $manager->setIdentifier($identifier);
        $manager->setEmail($request->request->get('email'));
        $manager->setRole(self::MAMAGER_ROLE);
        $manager->setPassword($encoded);
                    
        $dm = $this->getDocumentManager();
        $dm->persist($manager);
        $dm->flush();
            
        return $this->createUser([
            'role' => self::MAMAGER_ROLE,
            'email' => $request->request->get('email'),
            'plainPassword' => $request->request->get('plainPassword')
        ]);                
    }         
                        
}