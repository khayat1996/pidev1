<?php

namespace ForumBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ForumBundle\Entity\Post;
use ForumBundle\Form\PostType;
use ForumBundle\ForumBundle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MainBundle\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;
use CMEN\GoogleChartsBundle\CMENGoogleChartsBundle;


class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     * @Route("/", name="post_index")
     * @Method("GET")
     */


    public function indexAction(Request $request)
    {
        //return new Response($request);
        if ($request->get("search"))
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('ForumBundle:Post');
            $posts = $repo->createQueryBuilder('a')
                ->where('a.sujet LIKE :sujet')
                ->setParameter('sujet', '%'.$request->get("search").'%')
                ->getQuery()->getResult();
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            $posts = $em->getRepository('ForumBundle:Post')->findAll();
        }
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('@Forum/Forum/index.html.twig', array(
                'posts' => $pagination)
        );

    }
    public function viewsinglePostAction($id,Request $request){




        $em = $this->getDoctrine()->getManager();
        $po = $em->getRepository('ForumBundle:Post')->find($id);
        $po->setViews($po->getViews()+1);
        $comments= $po->getComments();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $comments,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        $em->persist($po);
        $em->flush();
        return $this->render('@Forum/Forum/singlePost.html.twig', array(
            'post' => $po,'views'=>$po->getViews(),
            'comments' => $pagination
        ));
    }
    public function viewsingleUserPostAction($id){

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('ForumBundle:Post')->findAll();
        return $this->render('@Forum/Forum/singlePostUser.html.twig', array(
            'posts' => $posts,
            'userId' => $id
        ));
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/addPost", name="forum_add_post")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $post= new Post();
        if ($request->get("Categorie"))
        {
            $post->setSujet($request->get("sujet"));
            $post->setCategorie($request->get("Categorie"));
            $post->setDescription($request->get("desc"));
            $post->setUser($this->getUser());
            $post->setDateAjout(new \DateTime());
            $post->setViews(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            //return new Response($post);
            return $this->redirectToRoute('forum_homepage' );
        }
        return $this->render('@Forum/Forum/addPost.html.twig');

    }
    public function viewsinglePostDeleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $post = $em->getRepository('ForumBundle:Post')->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("forum_homepage");

    }
     public function GrapheAction ()
      {
          $pieChart = new PieChart();
          $em = $this->getDoctrine()->getManager();
          $posts = $em->getRepository('ForumBundle:Post')->findAll();
          $totalro=0;
          $totalint=0;
          $totalaide=0;
          $totalintart=0;
          $totalsocial=0;

          foreach($posts as $post)  {
              if (($post->getCategorie()) == 'Robotique')
              {
                  $totalro=$totalro+1;
              }
              if (($post->getCategorie()) == 'Internet of Things')
              {
                  $totalint=$totalint+1;
              }
              if (($post->getCategorie()) == 'Aide')
              {
                  $totalaide=$totalaide+1;
              }
              if (($post->getCategorie()) == 'intelligence artificielle')
              {
                  $totalintart=$totalintart+1;
              }
              if (($post->getCategorie()) == 'social engineering')
              {
                  $totalsocial=$totalsocial+1;
              }
          }
          $pieChart->getData()->setArrayToDataTable(
              [
                  ['Categorie', 'nombre de posts'],
                  ['Robotique',  $totalro ],
                  ['Internet of Things',  $totalint],
                  ['Aide', $totalaide],
                  ['Intelligence artificielle', $totalintart],
                  ['social engineering', $totalsocial],
              ]
          );
          $pieChart->getOptions()->setTitle('Pourcentages des posts par categorie');
          $pieChart->getOptions()->setHeight(500);
          $pieChart->getOptions()->setWidth(900);
          $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
          $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
          $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
          $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
          $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
          return $this->render('@Forum/Forum/graphe.html.twig', array('piechart' => $pieChart));
  }







}