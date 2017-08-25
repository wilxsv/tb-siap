<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmInsercionDependencia
 *
 * @ORM\Table(name="frm_insercion_dependencia", indexes={@ORM\Index(name="IDX_AECA1748B1403A61", columns={"id_grupo_insercion_dependiente"}), @ORM\Index(name="IDX_AECA174871CFA0BD", columns={"id_grupo_insercion_padre"})})
 * @ORM\Entity
 */
class FrmInsercionDependencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_insercion_dependencia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_destino", type="text", nullable=false)
     */
    private $campoDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_origen", type="text", nullable=false)
     */
    private $campoOrigen;

    /**
     * @var \FrmGrupoInsercion
     *
     * @ORM\ManyToOne(targetEntity="FrmGrupoInsercion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_insercion_dependiente", referencedColumnName="id")
     * })
     */
    private $idGrupoInsercionDependiente;

    /**
     * @var \FrmGrupoInsercion
     *
     * @ORM\ManyToOne(targetEntity="FrmGrupoInsercion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_insercion_padre", referencedColumnName="id")
     * })
     */
    private $idGrupoInsercionPadre;



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
     * Set campoDestino
     *
     * @param string $campoDestino
     * @return FrmInsercionDependencia
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
     * Set campoOrigen
     *
     * @param string $campoOrigen
     * @return FrmInsercionDependencia
     */
    public function setCampoOrigen($campoOrigen)
    {
        $this->campoOrigen = $campoOrigen;

        return $this;
    }

    /**
     * Get campoOrigen
     *
     * @return string 
     */
    public function getCampoOrigen()
    {
        return $this->campoOrigen;
    }

    /**
     * Set idGrupoInsercionDependiente
     *
     * @param \Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercionDependiente
     * @return FrmInsercionDependencia
     */
    public function setIdGrupoInsercionDependiente(\Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercionDependiente = null)
    {
        $this->idGrupoInsercionDependiente = $idGrupoInsercionDependiente;

        return $this;
    }

    /**
     * Get idGrupoInsercionDependiente
     *
     * @return \Application\CoreBundle\Entity\FrmGrupoInsercion 
     */
    public function getIdGrupoInsercionDependiente()
    {
        return $this->idGrupoInsercionDependiente;
    }

    /**
     * Set idGrupoInsercionPadre
     *
     * @param \Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercionPadre
     * @return FrmInsercionDependencia
     */
    public function setIdGrupoInsercionPadre(\Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercionPadre = null)
    {
        $this->idGrupoInsercionPadre = $idGrupoInsercionPadre;

        return $this;
    }

    /**
     * Get idGrupoInsercionPadre
     *
     * @return \Application\CoreBundle\Entity\FrmGrupoInsercion 
     */
    public function getIdGrupoInsercionPadre()
    {
        return $this->idGrupoInsercionPadre;
    }
}
