<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $participants = $em->getRepository('MainBundle:Participant')
            ->findAll();
        if (isset($participants)) {
            return $this->render('base.html.twig', array(
                'participants' => $participants
            ));
        }
    }

}
