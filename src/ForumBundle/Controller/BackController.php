<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Post;
use ForumBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class BackController extends Controller
{
    /**
     * Lists all post entities.
     *
     * @Route("/", name="post_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ForumBundle:Post')->findAll();
        return $this->render('@Forum/backOffice/index.html.twig', array(
            'posts' => $posts,
        ));
    }
    public function viewsinglePostAction($id){
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('ForumBundle:Post')->find($id);
        return $this->render('@Forum/backOffice/getSingle.html.twig', array(
            'post' => $post,
        ));
    }
    public function viewsingleUserPostAction($id){
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('ForumBundle:Post')->findAll();
        return $this->render('@Forum/backOffice/getSingleUser.html.twig', array(
            'posts' => $posts,
            'userId' => $id
        ));
    }
    public function viewsinglePostDeleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $post = $em->getRepository('ForumBundle:Post')->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("back_view_user_posts");

        //return new Response($post);
    }
    public function viewsinglePostDeleteCommAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $post = $em->getRepository('ForumBundle:CommentairePost')->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("back_view_user_posts");

        //return new Response($post);
    }



}
