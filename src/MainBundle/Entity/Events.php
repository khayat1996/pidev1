<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MainBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Events
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="nom_org", columns={"nom_org"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MainBundle\Repository\EventsRepository")
 */
class Events
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEv;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     *
     * @ORM\Column(name="nom_org", type="string", length=50, nullable=false)
     */
    private $nomOrg;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     *
     * @ORM\Column(name="nom_event", type="string", length=50, nullable=false)
     */
    private $nomEvent;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     *
     * @ORM\Column(name="lieu", type="string", length=50, nullable=false)
     */
    private $lieu;


    /**
     * @var integer
     *  @Assert\Range(
     *      min = 10,
     *      max = 200,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     * @ORM\Column(name="nb_place", type="integer", nullable=false)
     */
    protected $nbPlace;

    /**
     * @var \DateTime
     * @Assert\GreaterThanOrEqual("+1 hours")
     *
     * @ORM\Column(name="dt_event", type="date", nullable=false)
     */
    private $dtEvent;

    /**
     * @var integer
     * @Assert\Range(
     *      min = 0,
     *      max = 180,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min=5)
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=false)
     */
    private $etat;

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
     * @return string
     */
    public function getNomOrg()
    {
        return $this->nomOrg;
    }

    /**
     * @param string $nomOrg
     */
    public function setNomOrg($nomOrg)
    {
        $this->nomOrg = $nomOrg;
    }

    /**
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * @param string $nomEvent
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return int
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * @param int $nbPlace
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;
    }

    /**
     * @return \DateTime
     */
    public function getDtEvent()
    {
        return $this->dtEvent;
    }

    /**
     * @param \DateTime $dtEvent
     */
    public function setDtEvent($dtEvent)
    {
        $this->dtEvent = $dtEvent;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


    public function __construct()
    {

        $this->dtEvent = new \DateTime('now');
    }

}

