<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlGrupoEstado
 *
 * @ORM\Table(name="ctl_grupo_estado", indexes={@ORM\Index(name="IDX_A94EB91ACAC67ADB", columns={"id_modulo"})})
 * @ORM\Entity
 */
class CtlGrupoEstado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_grupo_estado_id_seq", allocationSize=1, initialValue=1)
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
     * @var \Minsal\LaboratorioBundle\CtlModulo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\CtlModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id")
     * })
     */
    private $idModulo;



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
     * @return CtlGrupoEstado
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
     * @return CtlGrupoEstado
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
     * Set idModulo
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlModulo $idModulo
     * @return CtlGrupoEstado
     */
    public function setIdModulo(\Minsal\LaboratorioBundle\Entity\CtlModulo $idModulo = null)
    {
        $this->idModulo = $idModulo;

        return $this;
    }

    /**
     * Get idModulo
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlModulo
     */
    public function getIdModulo()
    {
        return $this->idModulo;
    }
}
