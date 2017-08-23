<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmGrupoInsercion
 *
 * @ORM\Table(name="frm_grupo_insercion")
 * @ORM\Entity
 */
class FrmGrupoInsercion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_grupo_insercion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \FrmFormulario
     *
     * @ORM\ManyToOne(targetEntity="FrmFormulario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formulario", referencedColumnName="id")
     * })
     */
    private $idFormulario;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_destino", type="string", nullable=false)
     */
    private $tablaDestino;

    /**
     * @var boolean
     *
     * @ORM\Column(name="insercion_falsa", type="boolean", nullable=false)
     */
    private $insercionFalsa = false;

    /**
     * @var string
     *
     * @ORM\Column(name="aux_filter_select", type="string", nullable=true)
     */
    private $auxFilterSelect;

    /**
     * @var string
     *
     * @ORM\Column(name="aux_filter_update", type="string", nullable=true)
     */
    private $auxFilterUpdate;



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
     * Set idFormulario
     *
     * @param \Application\CoreBundle\Entity\FrmFormulario $idFormulario
     * @return FrmGrupoInsercion
     */
    public function setIdFormulario(\Application\CoreBundle\Entity\FrmFormulario $idFormulario = null)
    {
        $this->idFormulario = $idFormulario;

        return $this;
    }

    /**
     * Get idFormulario
     *
     * @return \Application\CoreBundle\Entity\FrmFormulario
     */
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }

    /**
     * Set tablaDestino
     *
     * @param string $tablaDestino
     * @return FrmGrupoInsercion
     */
    public function setTablaDestino($tablaDestino)
    {
        $this->tablaDestino = $tablaDestino;

        return $this;
    }

    /**
     * Get tablaDestino
     *
     * @return string
     */
    public function getTablaDestino()
    {
        return $this->tablaDestino;
    }

    /**
     * Set insercionFalsa
     *
     * @param boolean $insercionFalsa
     * @return FrmGrupoInsercion
     */
    public function setInsercionFalsa($insercionFalsa) {
        $this->insercionFalsa = $insercionFalsa;

        return $this;
    }

    /**
     * Get insercionFalsa
     *
     * @return boolean
     */
    public function getInsercionFalsa() {
        return $this->insercionFalsa;
    }

    /**
     * Set auxFilterSelect
     *
     * @param string $auxFilterSelect
     * @return FrmGrupoInsercion
     */
    public function setAuxFilterSelect($auxFilterSelect)
    {
        $this->auxFilterSelect = $auxFilterSelect;

        return $this;
    }

    /**
     * Get auxFilterSelect
     *
     * @return string
     */
    public function getAuxFilterSelect()
    {
        return $this->auxFilterSelect;
    }

    /**
     * Set auxFilterUpdate
     *
     * @param string $auxFilterUpdate
     * @return FrmGrupoInsercion
     */
    public function setAuxFilterUpdate($auxFilterUpdate)
    {
        $this->auxFilterUpdate = $auxFilterUpdate;

        return $this;
    }

    /**
     * Get auxFilterUpdate
     *
     * @return string
     */
    public function getAuxFilterUpdate()
    {
        return $this->auxFilterUpdate;
    }
}
