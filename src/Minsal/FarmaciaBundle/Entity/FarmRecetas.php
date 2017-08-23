<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FarmRecetas
 *
 * @ORM\Table(name="farm_recetas", indexes={@ORM\Index(name="IDX_E9C07BE845BCCC8", columns={"idarea"}), @ORM\Index(name="IDX_E9C07BE8947B0200", columns={"idfarmacia"}), @ORM\Index(name="IDX_E9C07BE86A681526", columns={"id_franja_horaria"}), @ORM\Index(name="IDX_E9C07BE8A92D004C", columns={"idhistorialclinico"})})
 * @ORM\Entity
 */
class FarmRecetas {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="farm_recetas_idreceta_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="idestado", type="string", nullable=true)
     */
    private $idestado;

    /**
     * @var \Minsal\FarmaciaBundle\Entity\FarmEstados
     *
     * @ORM\ManyToOne(targetEntity="Minsal\FarmaciaBundle\Entity\FarmEstados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estados", referencedColumnName="id")
     * })
     */
    private $idEstados;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpersonal", type="integer", nullable=true)
     */
    private $idpersonal;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroreceta", type="integer", nullable=true)
     */
    private $numeroreceta;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpersonalintro", type="integer", nullable=true)
     */
    private $idpersonalintro;

    /**
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="integer", nullable=true)
     */
    private $correlativo;

    /**
     * @var string
     *
     * @ORM\Column(name="correlativoanual", type="string", length=100, nullable=true)
     */
    private $correlativoanual;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpersonaldespacho", type="integer", nullable=true)
     */
    private $idpersonaldespacho;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idestablecimiento;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlModalidad
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlModalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmodalidad", referencedColumnName="id")
     * })
     */
    private $idmodalidad;

    /**
     * @var \MntFarmacia
     *
     * @ORM\ManyToOne(targetEntity="MntFarmacia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idfarmacia", referencedColumnName="id")
     * })
     */
    private $idfarmacia;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntRangohora
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntRangohora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_franja_horaria", referencedColumnName="id")
     * })
     */
    private $idFranjaHoraria;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idhistorialclinico", referencedColumnName="id")
     * })
     */
    private $idhistorialclinico;

     /**
     * @var \MntAreafarmacia
     *
     * @ORM\ManyToOne(targetEntity="MntAreafarmacia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idarea", referencedColumnName="id")
     * })
     */
    private $idarea;


    /**
     * @var \Minsal\FarmaciaBundle\Entity\FarmRangohora
     *
     * @ORM\ManyToOne(targetEntity="Minsal\FarmaciaBundle\Entity\FarmRangohora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rangohora", referencedColumnName="id")
     * })
     */
     private $idRangohora;

     /**
      * @var string
      *
      * @ORM\Column(name="pacientestable", type="string", length=1, nullable=true)
      */
     private $pacientestable;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return FarmRecetas
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set idestado
     *
     * @param string $idestado
     * @return FarmRecetas
     */
    public function setIdestado($idestado) {
        $this->idestado = $idestado;

        return $this;
    }

    /**
     * Get idestado
     *
     * @return string
     */
    public function getIdestado() {
        return $this->idestado;
    }

    /**
     * Set idpersonal
     *
     * @param integer $idpersonal
     * @return FarmRecetas
     */
    public function setIdpersonal($idpersonal) {
        $this->idpersonal = $idpersonal;

        return $this;
    }

    /**
     * Get idpersonal
     *
     * @return integer
     */
    public function getIdpersonal() {
        return $this->idpersonal;
    }

    /**
     * Set numeroreceta
     *
     * @param integer $numeroreceta
     * @return FarmRecetas
     */
    public function setNumeroreceta($numeroreceta) {
        $this->numeroreceta = $numeroreceta;

        return $this;
    }

    /**
     * Get numeroreceta
     *
     * @return integer
     */
    public function getNumeroreceta() {
        return $this->numeroreceta;
    }

    /**
     * Set idpersonalintro
     *
     * @param integer $idpersonalintro
     * @return FarmRecetas
     */
    public function setIdpersonalintro($idpersonalintro) {
        $this->idpersonalintro = $idpersonalintro;

        return $this;
    }

    /**
     * Get idpersonalintro
     *
     * @return integer
     */
    public function getIdpersonalintro() {
        return $this->idpersonalintro;
    }

    /**
     * Set correlativo
     *
     * @param integer $correlativo
     * @return FarmRecetas
     */
    public function setCorrelativo($correlativo) {
        $this->correlativo = $correlativo;

        return $this;
    }

    /**
     * Get correlativo
     *
     * @return integer
     */
    public function getCorrelativo() {
        return $this->correlativo;
    }

    /**
     * Set correlativoanual
     *
     * @param string $correlativoanual
     * @return FarmRecetas
     */
    public function setCorrelativoanual($correlativoanual) {
        $this->correlativoanual = $correlativoanual;

        return $this;
    }

    /**
     * Get correlativoanual
     *
     * @return string
     */
    public function getCorrelativoanual() {
        return $this->correlativoanual;
    }

    /**
     * Set idpersonaldespacho
     *
     * @param integer $idpersonaldespacho
     * @return FarmRecetas
     */
    public function setIdpersonaldespacho($idpersonaldespacho) {
        $this->idpersonaldespacho = $idpersonaldespacho;

        return $this;
    }

    /**
     * Get idpersonaldespacho
     *
     * @return integer
     */
    public function getIdpersonaldespacho() {
        return $this->idpersonaldespacho;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return FarmRecetas
     */
    public function setIdestablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento = null) {
        $this->idestablecimiento = $idestablecimiento;

        return $this;
    }

    /**
     * Get idestablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdestablecimiento() {
        return $this->idestablecimiento;
    }

    /**
     * Set idmodalidad
     *
     * @param \Minsal\SiapsBundle\Entity\CtlModalidad $idmodalidad
     * @return FarmRecetas
     */
    public function setIdmodalidad(\Minsal\SiapsBundle\Entity\CtlModalidad $idmodalidad = null) {
        $this->idmodalidad = $idmodalidad;

        return $this;
    }

    /**
     * Get idmodalidad
     *
     * @return \Minsal\SiapsBundle\Entity\CtlModalidad
     */
    public function getIdmodalidad() {
        return $this->idmodalidad;
    }

    /**
     * Set idfarmacia
     *
     * @param \Minsal\FarmaciaBundle\Entity\MntFarmacia $idfarmacia
     * @return FarmRecetas
     */
    public function setIdfarmacia(\Minsal\FarmaciaBundle\Entity\MntFarmacia $idfarmacia = null) {
        $this->idfarmacia = $idfarmacia;

        return $this;
    }

    /**
     * Get idfarmacia
     *
     * @return \Minsal\FarmaciaBundle\Entity\MntFarmacia
     */
    public function getIdfarmacia() {
        return $this->idfarmacia;
    }

    /**
     * Set idFranjaHoraria
     *
     * @param \Minsal\SiapsBundle\Entity\MntRangohora $idFranjaHoraria
     * @return FarmRecetas
     */
    public function setIdFranjaHoraria(\Minsal\SiapsBundle\Entity\MntRangohora $idFranjaHoraria = null) {
        $this->idFranjaHoraria = $idFranjaHoraria;

        return $this;
    }

    /**
     * Get idFranjaHoraria
     *
     * @return \Minsal\SiapsBundle\Entity\MntRangohora
     */
    public function getIdFranjaHoraria() {
        return $this->idFranjaHoraria;
    }

    /**
     * Set idhistorialclinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idhistorialclinico
     * @return FarmRecetas
     */
    public function setIdhistorialclinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idhistorialclinico = null) {
        $this->idhistorialclinico = $idhistorialclinico;

        return $this;
    }

    /**
     * Get idhistorialclinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     */
    public function getIdhistorialclinico() {
        return $this->idhistorialclinico;
    }

    /**
     * Set idarea
     *
     * @param \Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idarea
     * @return FarmRecetas
     */
    public function setIdarea(\Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idarea = null)
    {
        $this->idarea = $idarea;

        return $this;
    }

    /**
     * Get idarea
     *
     * @return \Minsal\FarmaciaBundle\Entity\MntAreafarmacia
     */
    public function getIdarea()
    {
        return $this->idarea;
    }

    /**
     * Set idEstados
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmEstados $idEstados
     * @return FarmRecetas
     */
    public function setIdEstados(\Minsal\FarmaciaBundle\Entity\FarmEstados $idEstados = null)
    {
        $this->idEstados = $idEstados;

        return $this;
    }

    /**
     * Get idEstados
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmEstados
     */
    public function getIdEstados()
    {
        return $this->idEstados;
    }


    public function getIdestadoExtend()
    {
        switch ( trim($this->idestado)) {
            case 'E':
                return 'Entregada';
                break;
            case 'ER':
                return 'Repetitiva Entregada';
                break;
            case 'R':
                return 'Recetada';
                break;
            case 'RE':
                return 'Repetitiva';
                break;
            case 'P':
                return 'Proceso';
                break;
            case 'RP':
                return 'Receta Repetitiva Proceso';
                break;
            case 'L':
                return 'Receta Lista';
                break;
            case 'RL':
                return 'Receta Repetitiva Lista';
                break;
            case 'XX':
                return 'Receta en modificacion no finalizada';
                break;
        }
    }
    
    /**
     * Set idRangohora
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmRangohora $idRangohora
     * @return FarmRecetas
     */
    public function setIdRangohora(\Minsal\FarmaciaBundle\Entity\FarmRangohora $idRangohora = null) {
        $this->idRangohora = $idRangohora;

        return $this;
    }

    /**
     * Get idRangohora
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmRangohora
     */
    public function getIdRangohora() {
        return $this->idRangohora;
    }

    /**
     * Set pacientestable
     *
     * @param string $pacientestable
     * @return FarmRecetas
     */
    public function setPacientestable($pacientestable) {
        $this->pacientestable = $pacientestable;
        return $this;
    }

    /**
     * Get pacientestable
     *
     * @return string
     */
    public function getPacientestable() {
        return $this->pacientestable;
    }
}
