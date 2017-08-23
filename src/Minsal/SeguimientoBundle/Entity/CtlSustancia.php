<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlSustancia
 *
 * @ORM\Table(name="ctl_sustancia")
 * @ORM\Entity
 */
class CtlSustancia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_sustancia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_alternativo", type="string", length=50, nullable=true)
     */
    private $nombreAlternativo;



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
     * @return CtlSustancia
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
     * Set nombreAlternativo
     *
     * @param string $nombreAlternativo
     * @return CtlSustancia
     */
    public function setNombreAlternativo($nombreAlternativo)
    {
        $this->nombreAlternativo = $nombreAlternativo;

        return $this;
    }

    /**
     * Get nombreAlternativo
     *
     * @return string 
     */
    public function getNombreAlternativo()
    {
        return $this->nombreAlternativo;
    }
}
