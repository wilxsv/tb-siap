<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitCitasDia
 *
 * @ORM\Table(name="cit_citas_dia", indexes={@ORM\Index(name="fki_mnt_expediente_cit_citas_dia", columns={"id_expediente"}), @ORM\Index(name="fki_mnt_empleado_cit_citas_dia", columns={"id_empleado"}), @ORM\Index(name="fki_fos_user_user_reg_cit_citas_diaa", columns={"idusuarioreg"}), @ORM\Index(name="IDX_92DF133E6A540E", columns={"id_estado"}), @ORM\Index(name="IDX_92DF133E3FCE8D8B", columns={"id_justificacion"}), @ORM\Index(name="IDX_92DF133ECFE0D83", columns={"id_tipocita"}), @ORM\Index(name="IDX_92DF133E7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_92DF133ED5F9D21F", columns={"id_establecimiento_referencia"}), @ORM\Index(name="IDX_92DF133ECC2F8715", columns={"id_area_mod_estab"}), @ORM\Index(name="IDX_92DF133E8627A85B", columns={"id_aten_area_mod_estab"}), @ORM\Index(name="IDX_92DF133EEB971272", columns={"id_rangohora"}), @ORM\Index(name="IDX_92DF133E23BDDE75", columns={"id_prioridad"})})
 * @ORM\Entity(repositoryClass="Minsal\CitasBundle\Repositorio\CitCitasDiaRepository")
 */
class CitCitasDia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_citas_dia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var string
     *
     * @ORM\Column(name="ipcita", type="string", length=15, nullable=true)
     */
    private $ipcita;

    /**
     * @var string
     *
     * @ORM\Column(name="ipconfirmado", type="string", length=15, nullable=true)
     */
    private $ipconfirmado;

    /**
     * @var string
     *
     * @ORM\Column(name="cita_por", type="text", nullable=true)
     */
    private $citaPor;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_expediente_referencia", type="text", nullable=true)
     */
    private $numeroExpedienteReferencia;

    /**
     * @var \CitEstadoCita
     *
     * @ORM\ManyToOne(targetEntity="CitEstadoCita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \CitJustificacion
     *
     * @ORM\ManyToOne(targetEntity="CitJustificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_justificacion", referencedColumnName="id")
     * })
     */
    private $idJustificacion;

    /**
     * @var \CitTipocita
     *
     * @ORM\ManyToOne(targetEntity="CitTipocita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipocita", referencedColumnName="id")
     * })
     */
    private $idTipocita;

    /**
     * @var \Minsal\SiapsBundle\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \Minsal\SiapsBundle\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_referencia", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoReferencia;

    /**
     * @var \Minsal\SiapsBundle\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \Minsal\SiapsBundle\MntAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAreaModEstab;

    /**
     * @var \Minsal\SiapsBundle\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aten_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAtenAreaModEstab;

    /**
     * @var \Minsal\SiapsBundle\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

    /**
     * @var \Minsal\SiapsBundle\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @var \Minsal\SiapsBundle\MntRangohora
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntRangohora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rangohora", referencedColumnName="id")
     * })
     */
    private $idRangohora;

    /**
     * @var \CtlPrioridad
     *
     * @ORM\ManyToOne(targetEntity="CtlPrioridad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prioridad", referencedColumnName="id")
     * })
     */
    private $idPrioridad;

    /**
     * @var \Minsal\SiapsBundle\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var \Minsal\CitasBundle\CitDistribucion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitDistribucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_distribucion", referencedColumnName="id")
     * })
     */
    private $idDistribucion;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return CitCitasDia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CitCitasDia
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set ipcita
     *
     * @param string $ipcita
     * @return CitCitasDia
     */
    public function setIpcita($ipcita)
    {
        $this->ipcita = $ipcita;

        return $this;
    }

    /**
     * Get ipcita
     *
     * @return string
     */
    public function getIpcita()
    {
        return $this->ipcita;
    }

    /**
     * Set ipconfirmado
     *
     * @param string $ipconfirmado
     * @return CitCitasDia
     */
    public function setIpconfirmado($ipconfirmado)
    {
        $this->ipconfirmado = $ipconfirmado;

        return $this;
    }

    /**
     * Get ipconfirmado
     *
     * @return string
     */
    public function getIpconfirmado()
    {
        return $this->ipconfirmado;
    }

    /**
     * Set citaPor
     *
     * @param string $citaPor
     * @return CitCitasDia
     */
    public function setCitaPor($citaPor)
    {
        $this->citaPor = $citaPor;

        return $this;
    }

    /**
     * Get citaPor
     *
     * @return string
     */
    public function getCitaPor()
    {
        return $this->citaPor;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return CitCitasDia
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set idEstado
     *
     * @param \Minsal\CitasBundle\Entity\CitEstadoCita $idEstado
     * @return CitCitasDia
     */
    public function setIdEstado(\Minsal\CitasBundle\Entity\CitEstadoCita $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return \Minsal\CitasBundle\Entity\CitEstadoCita
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set idJustificacion
     *
     * @param \Minsal\CitasBundle\Entity\CitJustificacion $idJustificacion
     * @return CitCitasDia
     */
    public function setIdJustificacion(\Minsal\CitasBundle\Entity\CitJustificacion $idJustificacion = null)
    {
        $this->idJustificacion = $idJustificacion;

        return $this;
    }

    /**
     * Get idJustificacion
     *
     * @return \Minsal\CitasBundle\Entity\CitJustificacion
     */
    public function getIdJustificacion()
    {
        return $this->idJustificacion;
    }

    /**
     * Set idTipocita
     *
     * @param \Minsal\CitasBundle\Entity\CitTipocita $idTipocita
     * @return CitCitasDia
     */
    public function setIdTipocita(\Minsal\CitasBundle\Entity\CitTipocita $idTipocita = null)
    {
        $this->idTipocita = $idTipocita;

        return $this;
    }

    /**
     * Get idTipocita
     *
     * @return \Minsal\CitasBundle\Entity\CitTipocita
     */
    public function getIdTipocita()
    {
        return $this->idTipocita;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return CitCitasDia
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idEstablecimientoReferencia
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoReferencia
     * @return CitCitasDia
     */
    public function setIdEstablecimientoReferencia(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoReferencia = null)
    {
        $this->idEstablecimientoReferencia = $idEstablecimientoReferencia;

        return $this;
    }

    /**
     * Get idEstablecimientoReferencia
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoReferencia()
    {
        return $this->idEstablecimientoReferencia;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return CitCitasDia
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab
     * @return CitFechas
     */
    public function setIdAreaModEstab(\Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab = null)
    {
        $this->idAreaModEstab = $idAreaModEstab;

        return $this;
    }

    /**
     * Get idAreaModEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAreaModEstab
     */
    public function getIdAreaModEstab()
    {
        return $this->idAreaModEstab;
    }

    /**
     * Set idAtenAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab
     * @return CitCitasDia
     */
    public function setIdAtenAreaModEstab(\Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab = null)
    {
        $this->idAtenAreaModEstab = $idAtenAreaModEstab;

        return $this;
    }

    /**
     * Get idAtenAreaModEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     */
    public function getIdAtenAreaModEstab()
    {
        return $this->idAtenAreaModEstab;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return CitCitasDia
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return CitCitasDia
     */
    public function setIdExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idExpediente = null)
    {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente
     */
    public function getIdExpediente()
    {
        return $this->idExpediente;
    }

    /**
     * Set idRangohora
     *
     * @param \Minsal\SiapsBundle\Entity\MntRangohora $idRangohora
     * @return CitFechas
     */
    public function setIdRangohora(\Minsal\SiapsBundle\Entity\MntRangohora $idRangohora = null)
    {
        $this->idRangohora = $idRangohora;

        return $this;
    }

    /**
     * Get idRangohora
     *
     * @return \Minsal\SiapsBundle\Entity\MntRangohora
     */
    public function getIdRangohora()
    {
        return $this->idRangohora;
    }

    /**
     * Set idPrioridad
     *
     * @param \Minsal\CitasBundle\Entity\CtlPrioridad $idPrioridad
     * @return CitCitasDia
     */
    public function setIdPrioridad(\Minsal\CitasBundle\Entity\CtlPrioridad $idPrioridad = null)
    {
        $this->idPrioridad = $idPrioridad;

        return $this;
    }

    /**
     * Get idPrioridad
     *
     * @return \Minsal\CitasBundle\Entity\CtlPrioridad
     */
    public function getIdPrioridad()
    {
        return $this->idPrioridad;
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return CitCitasDia
     */
    public function setIdusuariomod(\Application\Sonata\UserBundle\Entity\User $idusuariomod = null)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return CitCitasDia
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set idDistribucion
     *
     * @param \Minsal\CitasBundle\Entity\CitDistribucion $idDistribucion
     * @return CitCitasDia
     */
    public function setIdDistribucion(\Minsal\CitasBundle\Entity\CitDistribucion $idDistribucion = null)
    {
        $this->idDistribucion = $idDistribucion;

        return $this;
    }

    /**
     * Get idDistribucion
     *
     * @return \Minsal\CitasBundle\Entity\CitDistribucion
     */
    public function getIdDistribucion()
    {
        return $this->idDistribucion;
    }

    public function createQueryBuilder($alias) {
        return $this->_em->createQueryBuilder()
                         ->select($alias)
                         ->from($this->_entityName, $alias);
    }

    public function __toString() {
        return $this->id ? $this->idTipocita->getTipoCita().' - '.$this->getFecha()->format('d/m/Y').' - '.$this->getIdRangohora().' - '.$this->getIdAtenAreaModEstab()->getIdAtencion()->getNombre().' - '.$this->getIdEstado()->getEstado().' - '.$this->getIdEmpleado()->getNombreempleado().' - '.$this->getIdExpediente().' - '.$this->getIdExpediente()->getIdPaciente()->getNombrePaciente().' - '.$this->getIdPrioridad() : '';
    }

    /**
     * Set numeroExpedienteReferencia
     *
     * @param string $numeroExpedienteReferencia
     * @return CitCitasDia
     */
    public function setNumeroExpedienteReferencia($numeroExpedienteReferencia)
    {
        $this->numeroExpedienteReferencia = $numeroExpedienteReferencia;

        return $this;
    }

    /**
     * Get numeroExpedienteReferencia
     *
     * @return string
     */
    public function getNumeroExpedienteReferencia()
    {
        return $this->numeroExpedienteReferencia;
    }
}
