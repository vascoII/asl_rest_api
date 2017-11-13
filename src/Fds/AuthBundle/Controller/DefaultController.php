<?php

namespace Fds\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FdsAuthBundle:Default:index.html.twig');
    }
}
