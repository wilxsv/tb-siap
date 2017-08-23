<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlOcupacion
 *
 * @ORM\Table(name="ctl_ocupacion")
 * @ORM\Entity
 */
class CtlOcupacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_ocupacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sumeve", type="integer", nullable=true)
     */
    private $idSumeve;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CtlOcupacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idSumeve
     *
     * @param integer $idSumeve
     * @return CtlOcupacion
     */
    public function setIdSumeve($idSumeve)
    {
        $this->idSumeve = $idSumeve;

        return $this;
    }

    /**
     * Get idSumeve
     *
     * @return integer
     */
    public function getIdSumeve()
    {
        return $this->idSumeve;
    }

    public function __toString() {
        return $this->nombre ? : '';
    }
}
