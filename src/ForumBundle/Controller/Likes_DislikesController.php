<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Likes_Dislikes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ForumBundle\Entity\Post;
class Likes_DislikesController extends Controller
{

    public function addinglelikeAction(Request $request)
    {
        if ($request->get('like')) {
            $em = $this->getDoctrine()->getManager();
            $post = $em->getRepository('ForumBundle:Post')->find($request->get('idPost'));
            $like = new Likes_Dislikes();
            $like->setPost($post);
            $like->setUser($this->getUser());
            $like->setType("like");
            $em->persist($like);
            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $post = $em->getRepository('ForumBundle:Post')->find($request->get('idPost'));
            $like = new Likes_Dislikes();
            $like->setPost($post);
            $like->setUser($this->getUser());
            $like->setType("dislike");
            $em->persist($like);
            $em->flush();
        }
        //return $this->render('@Forum/Forum/addPost.html.twig');
        return $this->redirectToRoute('forum_homepage' );
        //{{ path('forum_add_comment',{'id': post.id }) }}
    }
}
