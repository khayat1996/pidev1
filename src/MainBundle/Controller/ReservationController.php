<?php

namespace MainBundle\Controller;


use http\Env\Response;
use MainBundle\Entity\Solde;
use MainBundle\Form\EventType;
use MainBundle\Form\EventsType;

use MainBundle\Entity\Events;
use MainBundle\Controller\EventController;
use MainBundle\Entity\Reservation;
use MainBundle\MainBundle;
use MainBundle\Repository\ReservationRepository;
use mysql_xdevapi\DatabaseObject;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservation controller.
 *
 * @Route("reservation")
 */
class ReservationController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     * @Route("/", name="reservation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('MainBundle:Reservation')->findAll();

        return $this->render('reservation/index.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new reservation entity.
     *
     * @Route("/new", name="reservation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservation = new Reservation();
        $form = $this->createForm('MainBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservation_show', array('idTicket' => $reservation->getIdticket()));
        }

        return $this->render('reservation/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     * @Route("/", name="reservation_show")
     * @Method("GET")
     */
    public function showAction(Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('reservation/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing reservation entity.
     *
     * @Route("/{idTicket}/edit", name="reservation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('MainBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_edit', array('idTicket' => $reservation->getIdticket()));
        }

        return $this->render('reservation/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservation entity.
     *
     * @Route("/delete/{id}", name="reservation_delete")
     * @Method("DELETE")
     */
    public function viewsingleResDeleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $post = $em->getRepository('MainBundle:Reservation')->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("reservation_index");

    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservation $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('idTicket' => $reservation->getIdticket())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    /**
     * Creates a new reservation entity.

     * @Route("/new/{idEv}/{idPar}/{nom}/{prenom}/{image}/{nbPlace}", name="reservation_news")
     * @Method({"GET", "POST"})
     */
    public function newsAction($idEv,$idPar,$nom,$prenom,$image,$nbPlace)
    {
        $reservation = new Reservation($idEv,$idPar,$nom,$prenom,$image);




            $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Events::class)->find($idEv);
        $event->setNbPlace($nbPlace);

        $em->persist($event);
        $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('event_part', array('idEv' => $event->getIdev()));
    }






}
