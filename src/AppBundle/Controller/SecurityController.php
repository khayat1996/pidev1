<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SecurityController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Security:user_home.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/home")
     *
     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->IsGranted( 'ROLE_ADMIN')) {
            return $this->render('@App/Security/admin_home.html.twig');
        } else if ($authChecker->IsGranted('ROLE_USER')) {
            return $this->render('@App/Security/user_home.html.twig');
        } else{
            return $this->render('@FOSUser/Security/login.html.twig');

        }


    }

}
