<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MainBundle\Entity\Events;
use MainBundle\Entity\User;
/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="id_ev", columns={"id_ev"}), @ORM\Index(name="id_par", columns={"id_par"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ticket", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTicket;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Events")
     * @ORM\JoinColumn(name="Id_ev", referencedColumnName="id_ev")
     */
    private $idEv;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumn(name="id_par", referencedColumnName="id")
     */
    private $idPar;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=false)
     */
    private $image;

    /**
     * Reservation constructor.
     * @param int $idEv
     * @param int $idPar
     * @param string $nom
     * @param string $prenom
     * @param string $image
     */
    public function __construct($idEv=0, $idPar=0, $nom=null, $prenom=null, $image=null)
    {
        $this->idEv = $idEv;
        $this->idPar = $idPar;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getIdTicket()
    {
        return $this->idTicket;
    }

    /**
     * @param int $idTicket
     */
    public function setIdTicket($idTicket)
    {
        $this->idTicket = $idTicket;
    }

    /**
     * @return int
     */
    public function getIdEv()
    {
        return $this->idEv;
    }

    /**
     * @param int $idEv
     */
    public function setIdEv($idEv)
    {
        $this->idEv = $idEv;
    }

    /**
     * @return int
     */
    public function getIdPar()
    {
        return $this->idPar;
    }

    /**
     * @param int $idPar
     */
    public function setIdPar($idPar)
    {
        $this->idPar = $idPar;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}

