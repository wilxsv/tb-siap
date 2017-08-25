<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlGrupoEstadoDetalle
 *
 * @ORM\Table(name="ctl_grupo_estado_detalle", indexes={@ORM\Index(name="IDX_E4822C2699A3BA8", columns={"id_grupo_estado"})})
 * @ORM\Entity
 */
class CtlGrupoEstadoDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_grupo_estado_detalle_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \CtlGrupoEstado
     *
     * @ORM\ManyToOne(targetEntity="CtlGrupoEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_estado", referencedColumnName="id")
     * })
     */
    private $idGrupoEstado;



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
     * @return CtlGrupoEstadoDetalle
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlGrupoEstadoDetalle
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idGrupoEstado
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlGrupoEstado $idGrupoEstado
     * @return CtlGrupoEstadoDetalle
     */
    public function setIdGrupoEstado(\Minsal\SeguimientoBundle\Entity\CtlGrupoEstado $idGrupoEstado = null)
    {
        $this->idGrupoEstado = $idGrupoEstado;

        return $this;
    }

    /**
     * Get idGrupoEstado
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlGrupoEstado 
     */
    public function getIdGrupoEstado()
    {
        return $this->idGrupoEstado;
    }
}
