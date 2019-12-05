<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MainBundle\Entity\User;
/**
 * Solde
 *
 * @ORM\Table(name="solde")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\SoldeRepository")
 */
class Solde
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
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumn(name="id_par", referencedColumnName="id")
     */
    private $idPar;
    /**
     * @var int
     *
     * @ORM\Column(name="solde", type="integer",nullable=false)
     */
    private $solde;

    /**
     * @return mixed
     */
    public function getIdPar()
    {
        return $this->idPar;
    }

    /**
     * @param mixed $idPar
     */
    public function setIdPar($idPar)
    {
        $this->idPar = $idPar;
    }

    /**
     * @return int
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param int $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }

    /**
     * @return int
     */
    public function getNbParticipations()
    {
        return $this->nbParticipations;
    }

    /**
     * @param int $nbParticipations
     */
    public function setNbParticipations($nbParticipations)
    {
        $this->nbParticipations = $nbParticipations;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="nbParticipations", type="integer",nullable=false)
     */
    private $nbParticipations;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

