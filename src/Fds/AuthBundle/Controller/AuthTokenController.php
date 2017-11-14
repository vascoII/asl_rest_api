<?php

namespace Fds\AuthBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Fds\AslMongoBundle\Controller\CommonController;
use Fds\AuthBundle\Document\AuthToken;
use Fds\AuthBundle\Document\User;
use Fds\AslMongoBundle\Document\Owner;

class AuthTokenController extends CommonController
{
    const INVALID_CREDENTIAL = "Invalid Email/Password";
    /**
     * @ApiDoc(description="Create AuthToken")
     * 
     * @param Request $request
     * @return FOSView
     */
    public function postAuthTokensAction(Request $request)
    {
        $dm = $this->getDocumentManager();
        $encoder = $this->get('security.password_encoder');

        //manager
        $manager = $dm->getRepository('FdsAuthBundle:AuthToken')
            ->managerLogin($request->request->get('email'));
        //viewer
        $viewer = $dm->getRepository('FdsAuthBundle:AuthToken')
            ->viewerLogin($request->request->get('email'));
        
        if (
            $manager instanceof User && 
            $encoder->isPasswordValid(
                $manager, 
                $request->request->get('password')
            )    
        ) {
            $token = $dm->getRepository('FdsAuthBundle:AuthToken')
                ->tokenCreator($manager);
        } elseif (
            $viewer instanceof Owner &&
            $encoder->isPasswordValid(
                $viewer, 
                $request->request->get('password')
            )    
        ) {
            $token = $dm->getRepository('FdsAuthBundle:AuthToken')
                ->tokenCreator($viewer);
        } else {
            return $this->invalidCredentials(self::INVALID_CREDENTIAL);
        }
        return $this->getRead($token);
    }
    
    

}