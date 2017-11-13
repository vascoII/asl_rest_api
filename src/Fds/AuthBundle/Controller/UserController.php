<?php

namespace Fds\AuthBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Fds\AslMongoBundle\Controller\CommonController;

use Fds\AuthBundle\Document\User;
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
        if($request->get('asl_id')) {
            switch ($this->viewerExist($request)) { 
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
            }
        } else {
            switch ($this->managerExist($request)) { 
                case 'managerExist':
                    return $this->conflict(
                        'One manager is already registered'
                    );
                    break;
                case 'manager':
                    return $this->postCreateManager($request);
                    break;
            }
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
    
    private function postCreateManager($request, $identifier = 1)
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
             
    private function viewerExist($request)
    {   
        $asl = $this->aslExist($request->get('asl_id'));

        if ($asl instanceof Asl) {
            $criteria = [
                'email' => $request->request->get('email'),
                'asl' => $asl,
                'user' => true
            ];
            $user = $this->getDocumentManager()
                ->getRepository('FdsAslMongoBundle:Owner')
                ->findOneBy($criteria);

            if ($user instanceof Owner) {
                $response = 'viewerExist';
            } else {
                $response = 'viewer';
            }
        } else {
            $response = 'bad_Asl';
        }
        return $response;
    }
    
    private function managerExist($request)
    {
        $user = $this->getDocumentManager()
            ->getRepository('FdsAuthBundle:User')
            ->findOneByRole('Manager');
            
        if ($user) 
        {
            $response = 'managerExist';
        } else {
            $response = 'manager';
        }
        return $response;
    }
}