<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\CommentairePost;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ForumBundle\Form\CommentairePostType;

class CommentairePostController extends Controller
{
    /**
     * Lists all commentairepost entities.
     *
     * @Route("/", name="commentairepost_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentairepost = $em->getRepository('ForumBundle:CommentairePost')->findAll();

        return $this->render('@Forum/Forum/index.html.twig', array(
            'commentairepost' => $commentairepost,
        ));
    }
    public function addCommentAction(Request $request,$id)
    {
        $com= new CommentairePost();
        $em = $this->getDoctrine()->getManager();
        $post= $em->getRepository('ForumBundle:Post')->find($id);
        if ($request->get("Description"))
        {
            $com->setDescrption($request->get("Description"));
            $com->setUser($this->getUser());
            $com->setDateAjout(new \DateTime());
            $com->setPost($post);
            $em = $this->getDoctrine()->getManager();
            $em->persist($com);
            $em->flush();
            //return new Response($post);

            return $this->redirectToRoute('forum_homepage' );
        }
        return $this->render('@Forum/Forum/singlePost.html.twig');
        //return new Response($com);


    }
    public function viewsingleCommentDeleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $Com = $em->getRepository('ForumBundle:CommentairePost')->find($id);
        $em->remove($Com);
        $em->flush();
        return $this->redirectToRoute("forum_homepage");

        //return new Response($post);
    }



}
