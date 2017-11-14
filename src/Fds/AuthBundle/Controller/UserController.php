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
    /**
     * @ApiDoc(description="Create manager and Viewer(Owner)")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postUserAction(Request $request)
    {
        $viewer = new User();
        $encoder = $this->get('security.password_encoder');
        // le mot de passe en claire est encodé avant la sauvegarde
        $encoded = $encoder->encodePassword(
            $viewer, 
            $request->request->get('password')
        );
        $getIdPlusOneAdded = $this->getIdPlusOneAdded(
            $this->getParameter('constant_user')
        );    
        
        $user = $this->getDocumentManager()
            ->getRepository('FdsAuthBundle:User')
            ->postCreateUser(
                $request, 
                $viewer, 
                $encoded,
                $getIdPlusOneAdded
            );
        
        switch ($user) {
            case self::MANAGER_CREATED:
                return $this->createUser([
                    'role' => self::ROLE_MANAGER,
                    'email' => $request->request->get('email'),
                    'password' => $request->request->get('password')
                ]);
                break;
            case self::OWNER_USER_CREATED:
                return $this->createUser([
                    'role' => self::ROLE_OWNER,
                    'email' => $request->request->get('email'),
                    'password' => $request->request->get('password')
                ]);
                break;
            case self::OWNER_USER_ALREADY_CREATED:
                return $this->conflict(self::OWNER_USER_ALREADY_CREATED);
                break;
            case self::OWNER_USER_INVALID_DATA:
                return $this->invalidCredentials(self::INVALID_DATA_EMAIL);
                break;
        }
    }
    
}