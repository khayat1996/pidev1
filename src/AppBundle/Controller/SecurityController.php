<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
     * @Route("/home")

     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted( 'ROLE_ADMIN')) {
            return $this->render('baseback.html.twig');
        } else if ($authChecker->isGranted('ROLE_ORG')) {
            return $this->render('base.html.twig');
        }else if ($authChecker->isGranted('ROLE_USER')) {
            return $this->render('base.html.twig');
        } else{
            return $this->render('@FOSUser/Security/login.html.twig');

        }


    }




}