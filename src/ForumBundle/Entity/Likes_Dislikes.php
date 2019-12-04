<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ForumBundle\Entity\Post;
use ForumBundle\Entity\CommentairePost;

/**
 * Likes_Dislikes
 *
 * @ORM\Table(name="likes__dislikes")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\Likes_DislikesRepository")
 */
class Likes_Dislikes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;


    /**
     * Get id.
     *
     * @return int
     */

    /**
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id")
     */
    private $User;
    /**
     *
     * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Post")
     * @ORM\JoinColumn(name="Post_id",referencedColumnName="id")
     */
    private $Post;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->Post;
    }

    /**
     * @param mixed $Post
     */
    public function setPost($Post)
    {
        $this->Post = $Post;
    }

    /**
     * Set type.
     *
     * @param String $type
     *
     * @return Likes_Dislikes
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return binary
     */
    public function getType()
    {
        return $this->type;
    }
}
