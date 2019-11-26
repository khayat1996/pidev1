<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organisateur
 *
 * @ORM\Table(name="organisateur")
 * @ORM\Entity
 */
class Organisateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_org", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrg;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=50, nullable=false)
     */
    private $tel;


}

