<?php

namespace MainBundle\Controller;
use MainBundle\Form\EventType;
use MainBundle\Form\EventsType;
use MainBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Twilio\Rest\Client;

/**
 * Event controller.
 *
 */
class EventController extends Controller
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
            5/*limit per page*/
        );

        return $this->render('event/index.html.twig', array(
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
        $form = $this->createForm('MainBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('idEv' => $event->getIdev()));
        }

        return $this->render('event/new.html.twig', array(
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

        return $this->render('event/show.html.twig', array(
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
        $editForm = $this->createForm('MainBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_show', array('idEv' => $event->getIdev()));
        }

        return $this->render('event/edit.html.twig', array(
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

        return $this->redirectToRoute('event_index');
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
            ->setAction($this->generateUrl('event_delete', array('idEv' => $event->getIdev())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function organisateurAction()
    {
        return $this->render("organisateur.html.twig");

    }
    public function partAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('MainBundle:Events')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $events,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('event/part.html.twig', array(
            'events' => $pagination,
        ));
    }


    public function SMSAction()
    {
        $account_sid = 'ACca91cf830d7208dc322ac415cffccecc';
        $auth_token = 'c32ae36ec74340d4066b1c6a50531282';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
        $twilio_number = "+13312096739";

        $client = new Client($account_sid, $auth_token);

        $client->messages->create(
        // Where to send a text message (your cell phone?)
            '+21629288735',
            array(
                'from' => $twilio_number,
                'body' => 'votre evenement Create '
            )
        );



        return $this->redirectToRoute('event_index');

    }

    public function MailAction()
    {

        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 25, 'tls')
            ->setUsername('apismsm@gmail.com')
            ->setPassword('nino9tafouhkhayat');
        $mailer = new \Swift_Mailer($transport);
        $message=(new \Swift_Message('Events'))
            ->setFrom('apismsm@gmail.com')
            ->setTo('khayat.mohamed@esprit.tn')
            ->setBody('<h3> Votre Evenement Supprime</h3>','text/html');
        $mailer->send($message);
        return $this->redirectToRoute('event_index');

    }


}
