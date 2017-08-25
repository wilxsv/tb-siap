<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SecIngreso
 *
 * @ORM\Table(name="sec_historial_clinico")
 * @ORM\Entity(repositoryClass="Minsal\SeguimientoBundle\Repositorio\SecHistorialClinicoRepository")
 */
class SecHistorialClinico {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_historial_clinico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Minsal\SiapsBundle\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_numero_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fechaconsulta", type="date")
     */
    private $fechaconsulta;

    /**
     * @var \Minsal\SiapsBundle\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsubservicio", referencedColumnName="id")
     * })
     */
    private $idAtenAreaModEstab;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idUsuarioRegistra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime")
     */
    private $fechaRegistra;

    /**
     * @var string
     *
     * @ORM\Column(name="piloto", type="string", length=1)
     */
    private $piloto;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddress", type="string", length=15)
     */
    private $ipaddress;

    /**
     * @var \Minsal\SiapsBundle\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

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
     * @var integer
     *
     * @ORM\Column(name="idmodalidad", type="integer")
     */
    private $idModalidad;

    /**
     * @var SecMotivoConsulta
     *
     * @ORM\OneToOne(targetEntity="SecMotivoConsulta", mappedBy="idHistorialClinico",
     * cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $idMotivoConsulta;

    /**
     * @var \Minsal\SeguimientoBundle\CtlEstadoHistoriaClinica
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\CtlEstadoHistoriaClinica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_historia_clinica", referencedColumnName="id")
     * })
     */
    private $idEstadoHistoriaClinica;

    /**
     * @var \Application\CoreBundle\Entity\FrmFormulario
     *
     * @ORM\ManyToOne(targetEntity="Application\CoreBundle\Entity\FrmFormulario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formulario", referencedColumnName="id")
     * })
     */
    private $idFormulario;

    /**
     * @var \Minsal\CitasBundle\CitCitasDia
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitCitasDia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_dia", referencedColumnName="id")
     * })
     */
    private $idCitaDia;

    /**
     * @var SecOtrasObservaciones
     *
     * @ORM\OneToOne(targetEntity="SecOtrasObservaciones", mappedBy="idHistorialClinico", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $idOtrasObservaciones;

   /**
     * @var SecDatoEmbarazo
     *
     * @ORM\OneToOne(targetEntity="SecDatoEmbarazo", mappedBy="idHistorialClinico",
     * cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $idDatoEmbarazo;

    /**
     * @var \Minsal\SeguimientoBundle\CtlMotivoRetroactivo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\CtlMotivoRetroactivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo_retroactivo", referencedColumnName="id")
     * })
     */
    private $idMotivoRetroactivo;

    /**
     * @var \Minsal\SeguimientoBundle\CtlTipoHistoriaClinica
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\CtlTipoHistoriaClinica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_historia_clinica", referencedColumnName="id")
     * })
     */
    private $idTipoHistoriaClinica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time")
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time")
     */
    private $horaFin;

    /**
     *
     * @ORM\OneToMany(targetEntity="SecDiagnosticoPaciente", mappedBy="idHistorialClinico", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $diagnostico;

    /**
     * @ORM\OneToOne(targetEntity="SecHistorialLugar", mappedBy="idHistorialClinico", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $historialLugar;

    /**
     * @var \Minsal\SeguimientoBundle\SecSolicitudQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_quirurgica", referencedColumnName="id")
     * })
     */
    private $idSolicitudQuirurgica;

    function __construct() {
        $this->piloto = 'F';
    }

    public function __toString() {
        return $this->id ? str_replace('-','',$this->getIdExpediente()->getNumero()).'-'.$this->getFechaconsulta()->format('dmY') : '';
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fechaconsulta
     *
     * @param \Date $fechaconsulta
     * @return SecHistorialClinico
     */
    public function setFechaconsulta($fechaconsulta) {
        $this->fechaconsulta = $fechaconsulta;

        return $this;
    }

    /**
     * Get fechaconsulta
     *
     * @return \Date
     */
    public function getFechaconsulta() {
        return $this->fechaconsulta;
    }

    /**
     * Set fechaRegistra
     *
     * @param \DateTime $fechaRegistra
     * @return SecHistorialClinico
     */
    public function setFechaRegistra($fechaRegistra) {
        $this->fechaRegistra = $fechaRegistra;

        return $this;
    }

    /**
     * Get fechaRegistra
     *
     * @return \DateTime
     */
    public function getFechaRegistra() {
        return $this->fechaRegistra;
    }

    /**
     * Set piloto
     *
     * @param string $piloto
     * @return SecHistorialClinico
     */
    public function setPiloto($piloto) {
        $this->piloto = $piloto;

        return $this;
    }

    /**
     * Get piloto
     *
     * @return string
     */
    public function getPiloto() {
        return $this->piloto;
    }

    /**
     * Set idModalidad
     *
     * @param integer $idModalidad
     * @return SecHistorialClinico
     */
    public function setIdModalidad($idModalidad) {
        $this->idModalidad = $idModalidad;

        return $this;
    }

    /**
     * Get idModalidad
     *
     * @return integer
     */
    public function getIdModalidad() {
        return $this->idModalidad;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return SecHistorialClinico
     */
    public function setIdExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idExpediente = null) {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente
     */
    public function getIdExpediente() {
        return $this->idExpediente;
    }

    /**
     * Set idAtenAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab
     * @return SecHistorialClinico
     */
    public function setIdAtenAreaModEstab(\Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab = null) {
        $this->idAtenAreaModEstab = $idAtenAreaModEstab;

        return $this;
    }

    /**
     * Get idAtenAreaModEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     */
    public function getIdAtenAreaModEstab() {
        return $this->idAtenAreaModEstab;
    }

    /**
     * Set idUsuarioRegistra
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioRegistra
     * @return SecHistorialClinico
     */
    public function setIdUsuarioRegistra(\Application\Sonata\UserBundle\Entity\User $idUsuarioRegistra = null) {
        $this->idUsuarioRegistra = $idUsuarioRegistra;

        return $this;
    }

    /**
     * Get idUsuarioRegistra
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUsuarioRegistra() {
        return $this->idUsuarioRegistra;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return SecHistorialClinico
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null) {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimiento() {
        return $this->idEstablecimiento;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return SecHistorialClinico
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null) {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdEmpleado() {
        return $this->idEmpleado;
    }

    /**
     * Set idMotivoConsulta
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecMotivoConsulta $idMotivoConsulta
     * @return SecHistorialClinico
     */
    public function setIdMotivoConsulta(\Minsal\SeguimientoBundle\Entity\SecMotivoConsulta $idMotivoConsulta = null) {
        $this->idMotivoConsulta = $idMotivoConsulta;

        return $this;
    }

    /**
     * Get idMotivoConsulta
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecMotivoConsulta
     */
    public function getIdMotivoConsulta() {
        return $this->idMotivoConsulta;
    }

    /**
     * Set idEstadoHistoriaClinica
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlEstadoHistoriaClinica $idEstadoHistoriaClinica
     * @return SecHistorialClinico
     */
    public function setIdEstadoHistoriaClinica(\Minsal\SeguimientoBundle\Entity\CtlEstadoHistoriaClinica $idEstadoHistoriaClinica = null) {
        $this->idEstadoHistoriaClinica = $idEstadoHistoriaClinica;

        return $this;
    }

    /**
     * Get idEstadoHistoriaClinica
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlEstadoHistoriaClinica
     */
    public function getIdEstadoHistoriaClinica() {
        return $this->idEstadoHistoriaClinica;
    }

    /**
     * Set idCitaDia
     *
     * @param \Minsal\CitasBundle\Entity\CitCitasDia $idCitaDia
     * @return SecHistorialClinico
     */
    public function setIdCitaDia(\Minsal\CitasBundle\Entity\CitCitasDia $idCitaDia = null) {
        $this->idCitaDia = $idCitaDia;

        return $this;
    }

    /**
     * Get idCitaDia
     *
     * @return \Minsal\CitasBundle\Entity\CitCitasDia
     */
    public function getIdCitaDia() {
        return $this->idCitaDia;
    }

    /**
     * Set idFormulario
     *
     * @param \Application\CoreBundle\Entity\FrmFormulario $idFormulario
     * @return SecHistorialClinico
     */
    public function setIdFormulario(\Application\CoreBundle\Entity\FrmFormulario $idFormulario = null) {
        $this->idFormulario = $idFormulario;

        return $this;
    }

    /**
     * Get idFormulario
     *
     * @return \Application\CoreBundle\Entity\FrmFormulario
     */
    public function getIdFormulario() {
        return $this->idFormulario;
    }


    /**
     * Set idOtrasObservaciones
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecOtrasObservaciones $idOtrasObservaciones
     * @return SecHistorialClinico
     */
    public function setIdOtrasObservaciones(\Minsal\SeguimientoBundle\Entity\SecOtrasObservaciones $idOtrasObservaciones = null)
    {
        $this->idOtrasObservaciones = $idOtrasObservaciones;

        return $this;
    }

    /**
     * Get idOtrasObservaciones
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecOtrasObservaciones
     */
    public function getIdOtrasObservaciones()
    {
        return $this->idOtrasObservaciones;
    }

    /**
     * Set ipaddress
     *
     * @param string $ipaddress
     * @return SecHistorialClinico
     */
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    /**
     * Get ipaddress
     *
     * @return string
     */
    public function getIpaddress()
    {
        return $this->ipaddress;
    }

    /**
     * Set idDatoEmbarazo
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecDatoEmbarazo $idDatoEmbarazo
     * @return SecHistorialClinico
     */
    public function setIdDatoEmbarazo(\Minsal\SeguimientoBundle\Entity\SecDatoEmbarazo $idDatoEmbarazo = null)
    {
        $this->idDatoEmbarazo = $idDatoEmbarazo;

        return $this;
    }

    /**
     * Get idDatoEmbarazo
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecDatoEmbarazo
     */
    public function getIdDatoEmbarazo()
    {
        return $this->idDatoEmbarazo;
    }

    /**
     * Set idMotivoRetroactivo
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlMotivoRetroactivo $idMotivoRetroactivo
     * @return SecHistorialClinico
     */
    public function setIdMotivoRetroactivo(\Minsal\SeguimientoBundle\Entity\CtlMotivoRetroactivo $idMotivoRetroactivo = null) {
        $this->idMotivoRetroactivo = $idMotivoRetroactivo;

        return $this;
    }

    /**
     * Get idMotivoRetroactivo
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlMotivoRetroactivo
     */
    public function getIdMotivoRetroactivo() {
        return $this->idMotivoRetroactivo;
    }

    /**
     * Set idTipoHistoriaClinica
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoHistoriaClinica $idTipoHistoriaClinica
     * @return SecHistorialClinico
     */
    public function setIdTipoHistoriaClinica(\Minsal\SeguimientoBundle\Entity\CtlTipoHistoriaClinica $idTipoHistoriaClinica = null) {
        $this->idTipoHistoriaClinica = $idTipoHistoriaClinica;

        return $this;
    }

    /**
     * Get idTipoHistoriaClinica
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoHistoriaClinica
     */
    public function getIdTipoHistoriaClinica() {
        return $this->idTipoHistoriaClinica;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return SecHistorialClinico
     */
    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio() {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     * @return SecHistorialClinico
     */
    public function setHoraFin($horaFin) {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime
     */
    public function getHoraFin() {
        return $this->horaFin;
    }

    /**
     * Set historialLugar
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialLugar $historialLugar
     * @return SecHistorialClinico
     */
    public function setHistorialLugar(\Minsal\SeguimientoBundle\Entity\SecHistorialLugar $historialLugar = null)
    {
        $this->historialLugar = $historialLugar;

        return $this;
    }

    /**
     * Get historialLugar
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialLugar
     */
    public function getHistorialLugar()
    {
        return $this->historialLugar;
    }


    /**
     * Add diagnostico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecDiagnosticoPaciente $diagnostico
     * @return SecHistorialClinico
     */
    public function addDiagnostico(\Minsal\SeguimientoBundle\Entity\SecDiagnosticoPaciente $diagnostico)
    {
        $this->diagnostico[] = $diagnostico;

        return $this;
    }

    /**
     * Remove diagnostico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecDiagnosticoPaciente $diagnostico
     */
    public function removeDiagnostico(\Minsal\SeguimientoBundle\Entity\SecDiagnosticoPaciente $diagnostico)
    {
        $this->diagnostico->removeElement($diagnostico);
    }

    /**
     * Get diagnostico
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Set idSolicitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica $idSolicitudQuirurgica
     * @return SecHistorialClinico
     */
    public function setIdSolicitudQuirurgica(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica $idSolicitudQuirurgica = null) {
        $this->idSolicitudQuirurgica = $idSolicitudQuirurgica;

        return $this;
    }

    /**
     * Get idSolicitudQuirurgica
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica
     */
    public function getIdSolicitudQuirurgica() {
        return $this->idSolicitudQuirurgica;
    }
}
