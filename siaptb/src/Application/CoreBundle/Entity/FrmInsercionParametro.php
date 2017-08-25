<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmInsercionParametro
 *
 * @ORM\Table(name="frm_insercion_parametro", indexes={@ORM\Index(name="IDX_6D151B6FF1E1FDD5", columns={"id_grupo_insercion"})})
 * @ORM\Entity
 */
class FrmInsercionParametro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_insercion_parametro_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="campo_destino", type="text", nullable=false)
     */
    private $campoDestino;

    /**
     * @var \FrmGrupoInsercion
     *
     * @ORM\ManyToOne(targetEntity="FrmGrupoInsercion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_insercion", referencedColumnName="id")
     * })
     */
    private $idGrupoInsercion;



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
     * @return FrmInsercionParametro
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
     * Set campoDestino
     *
     * @param string $campoDestino
     * @return FrmInsercionParametro
     */
    public function setCampoDestino($campoDestino)
    {
        $this->campoDestino = $campoDestino;

        return $this;
    }

    /**
     * Get campoDestino
     *
     * @return string 
     */
    public function getCampoDestino()
    {
        return $this->campoDestino;
    }

    /**
     * Set idGrupoInsercion
     *
     * @param \Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercion
     * @return FrmInsercionParametro
     */
    public function setIdGrupoInsercion(\Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercion = null)
    {
        $this->idGrupoInsercion = $idGrupoInsercion;

        return $this;
    }

    /**
     * Get idGrupoInsercion
     *
     * @return \Application\CoreBundle\Entity\FrmGrupoInsercion 
     */
    public function getIdGrupoInsercion()
    {
        return $this->idGrupoInsercion;
    }
}
