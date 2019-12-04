<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ForumBundle\Entity\Post;
use ForumBundle\Entity\Likes_Dislikes;

/**
 * CommentairePost
 *
 * @ORM\Table(name="commentaire_post")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\CommentairePostRepository")
 */
class CommentairePost
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
     * @ORM\Column(name="Descrption", type="string", length=255)
     */
    private $descrption;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAjout", type="datetime")
     */
    private $dateAjout;



    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumn(name="IdUser", referencedColumnName="id")
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="Post_id",referencedColumnName="id")
     */
    private $Post;
    public function setPost($Post){
        $this->Post=$Post;
    }
    public function getPost(){
        return $this->Post;
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPost.
     *
     * @param int $idPost
     *
     * @return CommentairePost
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get idPost.
     *
     * @return int
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set idUser.
     *
     * @param int $idUser
     *
     * @return CommentairePost
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set descrption.
     *
     * @param string $descrption
     *
     * @return CommentairePost
     */
    public function setDescrption($descrption)
    {
        $this->descrption = $descrption;

        return $this;
    }

    /**
     * Get descrption.
     *
     * @return string
     */
    public function getDescrption()
    {
        return $this->descrption;
    }

    /**
     * Set dateAjout.
     *
     * @param \DateTime $dateAjout
     *
     * @return CommentairePost
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;


        return $this;
    }

    /**
     * Get dateAjout.
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
