<?php

namespace MainBundle\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use MainBundle\Form\EventsType;
use MainBundle\Form\RechercheType;
use MainBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;



/**
 * Event controller.
 *
 */
class EventsController extends Controller
{

    /**
     * Lists all event entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('MainBundle:Events')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $events,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('events/index.html.twig', array(
            'events' => $pagination,

        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Events();
        $form = $this->createForm('MainBundle\Form\EventsType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('events_show', array('idEv' => $event->getIdev()));
        }

        return $this->render('events/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('events/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('MainBundle\Form\EventsType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('events_show', array('idEv' => $event->getIdev()));
        }

        return $this->render('events/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Events $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('events_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('events_delete', array('idEv' => $event->getIdev())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function searchAction(Request $request)
    {
        $event = new Events();
        $form = $this->createForm(RechercheType::class, $event);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $event = $this->getDoctrine()
           ->getRepository(Events::class)
                ->findBy((array('nomEvent'=>$event->getNomEvent())));

        }
        else
        {
            $event = $this->getDoctrine()->getRepository(Events::class)->findAll();
        }
        return $this->render('events/search.html.twig', array('form'=> $form->createView(),'events' => $event));

    }
    public function basebackAction()
    {
        return $this->render("baseback.html.twig");

    }

    public function accepterAction($idEv, Request $request)
    {
      // $this->SMSAction();

        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Events::class)->find($idEv);
        $event->setEtat("Accepte");
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('events_index', array('idEv' => $event->getIdev()));
}
    public function refuserAction($idEv, Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Events::class)->find($idEv);
        $event->setEtat("refuse");
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('events_index', array('idEv' => $event->getIdev()));
    }
    public function SMSAction()
    {
        $account_sid = 'AC564d26deab05c8684882d7128e79a76a';
        $auth_token = '44d7b0630152762d627e78d613ff2b5a';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
        $twilio_number = "+18046813017";

        $client = new Client($account_sid, $auth_token);

            $client->messages->create(
            // Where to send a text message (your cell phone?)
                '+21629288735',
                array(
                    'from' => $twilio_number,
                    'body' => 'votre evenement est accepter '
                )
            );



        return $this->redirectToRoute('events_index');

    }
    public function deletAction($idEv)
    {
        $em =$this->getDoctrine()->getManager();
        $event =$em->getRepository( Events::class)->find($idEv);

        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute( "events_index");
    }
    public function allAction()
    {
        $event = $this->getDoctrine()->getManager()
            ->getRepository('MainBundle:Events')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }
    public function newsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Events();
        $event = setNomOrg($request->get('nomOrg'));
        $event = setNomEvent($request->get('nomEvent'));
        $event = setLieu($request->get('lieu'));
        $event = setNbPlace($request->get('nbPlace'));
        $event = setDtEvent($request->get('dtEvent'));
        $event = setsetPrix($request->get('prix'));
        $event = setDescription($request->get('description'));
        $event = setEtat($request->get('etat'));
        $em->persist($event);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }
    public function findAction($idEv){
        $event = $this->getDoctrine()->getManager()
            ->getRepository('MainBundle:Events')->find($idEv);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);

    }
}
