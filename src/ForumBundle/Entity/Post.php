<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MainBundle\Entity\User;
use ForumBundle\Entity\Likes_Dislikes;
use ForumBundle\Entity\CommentairePost;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="Categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var int
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet", type="string", length=255)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     * @ORM\Column(name="idUser", type="integer")
     **/

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAjout", type="datetime")
     */
    private $dateAjout;




    /**
     * @ORM\OneToMany(targetEntity="ForumBundle\Entity\CommentairePost", mappedBy="Post")
     */
    private $comments;


    /**
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id" )
     */

    private $User;

    /**
     *
     * @ORM\OneToMany(targetEntity="ForumBundle\Entity\Likes_Dislikes", mappedBy="Post")
     */

    private $Likes_dislikes;

    /**
     * @return mixed
     */
    public function getLikesDislikes()
    {
        return $this->Likes_dislikes;
    }

    /**
     * @param mixed $Likes_dislikes
     */
    public function setLikesDislikes($Likes_dislikes)
    {
        $this->Likes_dislikes = $Likes_dislikes;
    }


    /**
     * Get id.
     *
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }



    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set categorie.
     *
     * @param string $categorie
     *
     * @return Post
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie.
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set sujet.
     *
     * @param string $sujet
     *
     * @return Post
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet.
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Post
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateAjout.
     *
     * @param \DateTime $dateAjout
     *
     * @return Post
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

    /**
     * Set User.
     *
     * @param string $User
     *
     * @return Post
     */
    public function setUser($User)
    {
        $this->User = $User;

        return $this;
    }

    /**
     * Get User.
     *
     * @return User
     */

    public function getIdUser(){
        return $this->idUser;
    }
    public function setIdUser($idUser){
        $this->idUser=$idUser;
    }
    public function getUser()
    {
        return $this->User;
    }
    public function getComments(){
        return $this->comments;
    }
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->DateAjout = new \DateTime();
    }
    public function __toString()
    {
        return $this->sujet." ".$this->categorie." ".$this->idUser." ".$this->description." ".$this->getDateAjout()->format('Y-m-d-H-i-s');
    }
}
