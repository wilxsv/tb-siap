<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmFormulario
 *
 * @ORM\Table(name="frm_formulario")
 * @ORM\Entity(repositoryClass="Application\CoreBundle\Entity\FrmFormularioRepository")
 */
class FrmFormulario {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_formulario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=25, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

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
     * @var boolean
     *
     * @ORM\Column(name="publicado", type="boolean", nullable=false)
     */
    private $publicado = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_publicacion", type="date", nullable=true)
     */
    private $fechaPublicacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="config_guardado", type="boolean", nullable=true)
     */
    private $configGuardado = false;

    /**
     * @var string
     *
     * @ORM\Column(name="vista_edit", type="text", nullable=true)
     */
    private $vistaEdit = null;

    /**
     * @var string
     *
     * @ORM\Column(name="vista_show", type="text", nullable=true)
     */
    private $vistaShow = null;

    /**
     * @var string
     *
     * @ORM\Column(name="vista_to_print", type="text", nullable=true)
     */
    private $vistaToPrint = null;

    /**
     * @var \FrmTipoFormulario
     *
     * @ORM\ManyToOne(targetEntity="FrmTipoFormulario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_formulario", referencedColumnName="id")
     * })
     */
    private $idTipoFormulario;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return FrmFormulario
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return FrmFormulario
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo() {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return FrmFormulario
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return FrmFormulario
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo() {
        return $this->activo;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return FrmFormulario
     */
    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return FrmFormulario
     */
    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin() {
        return $this->fechaFin;
    }

    /**
     * Set publicado
     *
     * @param boolean $publicado
     * @return FrmFormulario
     */
    public function setPublicado($publicado) {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return boolean
     */
    public function getPublicado() {
        return $this->publicado;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     * @return FrmFormulario
     */
    public function setFechaPublicacion($fechaPublicacion) {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime
     */
    public function getFechaPublicacion() {
        return $this->fechaPublicacion;
    }

    /**
     * Set configGuardado
     *
     * @param boolean $configGuardado
     * @return FrmFormulario
     */
    public function setConfigGuardado($configGuardado) {
        $this->configGuardado = $configGuardado;

        return $this;
    }

    /**
     * Get configGuardado
     *
     * @return boolean
     */
    public function getConfigGuardado() {
        return $this->configGuardado;
    }

    public function __toString() {
        return $this->nombre ? : ' ';
    }


    /**
     * Set vistaEdit
     *
     * @param string $vistaEdit
     * @return FrmFormulario
     */
    public function setVistaEdit($vistaEdit)
    {
        $this->vistaEdit = $vistaEdit;

        return $this;
    }

    /**
     * Get vistaEdit
     *
     * @return string
     */
    public function getVistaEdit()
    {
        return $this->vistaEdit;
    }

    /**
     * Set vistaShow
     *
     * @param string $vistaShow
     * @return FrmFormulario
     */
    public function setVistaShow($vistaShow)
    {
        $this->vistaShow = $vistaShow;

        return $this;
    }

    /**
     * Get vistaShow
     *
     * @return string
     */
    public function getVistaShow()
    {
        return $this->vistaShow;
    }

    /**
     * Set idTipoFormulario
     *
     * @param \Application\CoreBundle\Entity\FrmTipoFormulario $idTipoFormulario
     * @return FrmFormulario
     */
    public function setIdTipoFormulario(\Application\CoreBundle\Entity\FrmTipoFormulario $idTipoFormulario = null)
    {
        $this->idTipoFormulario = $idTipoFormulario;

        return $this;
    }

    /**
     * Get idTipoFormulario
     *
     * @return \Application\CoreBundle\Entity\FrmTipoFormulario
     */
    public function getIdTipoFormulario()
    {
        return $this->idTipoFormulario;
    }



    /**
     * Set vistaToPrint
     *
     * @param string $vistaToPrint
     * @return FrmFormulario
     */
    public function setVistaToPrint($vistaToPrint)
    {
        $this->vistaToPrint = $vistaToPrint;

        return $this;
    }

    /**
     * Get vistaToPrint
     *
     * @return string 
     */
    public function getVistaToPrint()
    {
        return $this->vistaToPrint;
    }
}
