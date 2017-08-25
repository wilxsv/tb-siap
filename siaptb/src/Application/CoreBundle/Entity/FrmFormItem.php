<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmFormItem
 *
 * @ORM\Table(name="frm_form_item", indexes={@ORM\Index(name="IDX_D77F6F37AAE0DD79", columns={"id_tipo_objeto"})})
 * @ORM\Entity
 */
class FrmFormItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_form_item_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_descriptivo", type="text", nullable=false)
     */
    private $nombreDescriptivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje_ayuda", type="text", nullable=true)
     */
    private $mensajeAyuda;

    /**
     * @var integer
     *
     * @ORM\Column(name="inscripcion", type="integer", nullable=true)
     */
    private $inscripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="validacion_especial", type="text", nullable=true)
     */
    private $validacionEspecial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio = 'now';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var \CtlTipoObjeto
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoObjeto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_objeto", referencedColumnName="id")
     * })
     */
    private $idTipoObjeto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ocultar_opciones", type="boolean", nullable=true)
     */
    private $ocultarOpciones = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pre_seleccionado", type="boolean", nullable=true)
     */
    private $preSeleccionado = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aplicar_plugin_mascara", type="boolean", nullable=true)
     */
    private $aplicarPluginMascara = false;


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
     * Set nombreDescriptivo
     *
     * @param string $nombreDescriptivo
     * @return FrmFormItem
     */
    public function setNombreDescriptivo($nombreDescriptivo)
    {
        $this->nombreDescriptivo = $nombreDescriptivo;

        return $this;
    }

    /**
     * Get nombreDescriptivo
     *
     * @return string
     */
    public function getNombreDescriptivo()
    {
        return $this->nombreDescriptivo;
    }

    /**
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     * @return FrmFormItem
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return integer
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set mensajeAyuda
     *
     * @param string $mensajeAyuda
     * @return FrmFormItem
     */
    public function setMensajeAyuda($mensajeAyuda)
    {
        $this->mensajeAyuda = $mensajeAyuda;

        return $this;
    }

    /**
     * Get mensajeAyuda
     *
     * @return string
     */
    public function getMensajeAyuda()
    {
        return $this->mensajeAyuda;
    }

    /**
     * Set inscripcion
     *
     * @param integer $inscripcion
     * @return FrmFormItem
     */
    public function setInscripcion($inscripcion)
    {
        $this->inscripcion = $inscripcion;

        return $this;
    }

    /**
     * Get inscripcion
     *
     * @return integer
     */
    public function getInscripcion()
    {
        return $this->inscripcion;
    }

    /**
     * Set validacionEspecial
     *
     * @param string $validacionEspecial
     * @return FrmFormItem
     */
    public function setValidacionEspecial($validacionEspecial)
    {
        $this->validacionEspecial = $validacionEspecial;

        return $this;
    }

    /**
     * Get validacionEspecial
     *
     * @return string
     */
    public function getValidacionEspecial()
    {
        return $this->validacionEspecial;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return FrmFormItem
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return FrmFormItem
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return FrmFormItem
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set idTipoObjeto
     *
     * @param \Application\CoreBundle\Entity\CtlTipoObjeto $idTipoObjeto
     * @return FrmFormItem
     */
    public function setIdTipoObjeto(\Application\CoreBundle\Entity\CtlTipoObjeto $idTipoObjeto = null)
    {
        $this->idTipoObjeto = $idTipoObjeto;

        return $this;
    }

    /**
     * Get idTipoObjeto
     *
     * @return \Application\CoreBundle\Entity\CtlTipoObjeto
     */
    public function getIdTipoObjeto()
    {
        return $this->idTipoObjeto;
    }

    /**
     * Set ocultarOpciones
     *
     * @param boolean $ocultarOpciones
     * @return FrmFormItem
     */
    public function setOcultarOpciones($ocultarOpciones)
    {
        $this->ocultarOpciones = $ocultarOpciones;

        return $this;
    }

    /**
     * Get ocultarOpciones
     *
     * @return boolean
     */
    public function getOcultarOpciones()
    {
        return $this->ocultarOpciones;
    }

    /**
     * Set preSeleccionado
     *
     * @param boolean $preSeleccionado
     * @return FrmFormItem
     */
    public function setPreSeleccionado($preSeleccionado)
    {
        $this->preSeleccionado = $preSeleccionado;

        return $this;
    }

    /**
     * Get preSeleccionado
     *
     * @return boolean
     */
    public function getPreSeleccionado()
    {
        return $this->preSeleccionado;
    }

    /**
     * Set aplicarPluginMascara
     *
     * @param boolean $aplicarPluginMascara
     * @return FrmFormItem
     */
    public function setAplicarPluginMascara($aplicarPluginMascara)
    {
        $this->aplicarPluginMascara = $aplicarPluginMascara;

        return $this;
    }

    /**
     * Get aplicarPluginMascara
     *
     * @return boolean
     */
    public function getAplicarPluginMascara()
    {
        return $this->aplicarPluginMascara;
    }

    public function __toString()
    {
        return $this->nombreDescriptivo ?: ' ';
    }

    public function getTipoOrigenExtend()
    {
        if($this->tipoOrigen==1)
            return '1 - Catálogo';
        else
        if($this->tipoOrigen==2)
            return '2 - Campo Normal';
    }
}
