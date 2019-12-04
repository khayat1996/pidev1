<?php


namespace MainBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity
 */
class Media
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_media", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMedia;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="date", nullable=true)
     */
    private $dateCreate ;
    /**
     * @return int
     */
    public function getIdMedia()
    {
        return $this->idMedia;
    }

    /**
     * @param int $idMedia
     */
    public function setIdMedia($idMedia)
    {
        $this->idMedia = $idMedia;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * @param \DateTime $dateCreate
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }

    public function __construct()
    {

        $this->dateCreate = new \DateTime('now');
    }


}
