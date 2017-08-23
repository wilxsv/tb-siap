<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSolicitudestudios
 *
 * @ORM\Table(name="sec_solicitudestudios", indexes={@ORM\Index(name="fki_fos_user_user_sec_solicitudestudios", columns={"idusuarioreg"}), @ORM\Index(name="fki_sec_solicitud_estudfios_mnt_aten_area_mod_estab", columns={"id_atencion"}), @ORM\Index(name="IDX_7CE0B616DA799B26", columns={"id_establecimiento_externo"}), @ORM\Index(name="IDX_7CE0B6167DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_7CE0B616265DE1E3", columns={"estado"}), @ORM\Index(name="IDX_7CE0B616701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_7CE0B61631827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_7CE0B616174D74B2", columns={"idtiposolicitud"}), @ORM\Index(name="IDX_7CE0B616F483997", columns={"id_dato_referencia"})})
 * @ORM\Entity(repositoryClass="Minsal\SeguimientoBundle\Repositorio\SecSolicitudestudiosRepository")
 */
class SecSolicitudestudios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_solicitudestudios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=true)
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var integer
     *
     * @ORM\Column(name="impresiones", type="integer", nullable=true)
     */
    private $impresiones = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cama", type="integer", nullable=true)
     */
    private $cama = '0';

    /**
     * @var \Minsal\SiapsBundle\CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

    /**
     * @var \Minsal\LaboratorioBundle\MntDatoReferencia
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\MntDatoReferencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_dato_referencia", referencedColumnName="id")
     * })
     */
    private $idDatoReferencia;

    /**
     * @var \Minsal\SiapsBundle\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_externo", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoExterno;

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
     * @var \Minsal\LaboratorioBundle\CtlEstadoServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado", referencedColumnName="id")
     * })
     */
    private $estado;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;

    /**
     * @var \Minsal\LaboratorioBundle\LabTiposolicitud
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabTiposolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtiposolicitud", referencedColumnName="id")
     * })
     */
    private $idtiposolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mensaje_codificado", type="datetime", nullable=true)
     */
    private $fechaMensajeCodificado;




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
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     * @return SecSolicitudestudios
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return SecSolicitudestudios
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
     * Get fechaMensajeCodificado
     *
     * @return \DateTime
     */
    public function getFechaMensajeCodificado()
    {
        return $this->fechaMensajeCodificado;
    }

    /**
     * Set fechaMensajeCodificado
     *
     * @param \DateTime $fechaMensajeCodificado
     * @return SecSolicitudestudios
     */
    public function setFechaMensajeCodificado($fechaMensajeCodificado)
    {
        $this->fechaMensajeCodificado = $fechaMensajeCodificado;

        return $this;
    }




    /**
     * Set impresiones
     *
     * @param integer $impresiones
     * @return SecSolicitudestudios
     */
    public function setImpresiones($impresiones)
    {
        $this->impresiones = $impresiones;

        return $this;
    }

    /**
     * Get impresiones
     *
     * @return integer
     */
    public function getImpresiones()
    {
        return $this->impresiones;
    }

    /**
     * Set cama
     *
     * @param integer $cama
     * @return SecSolicitudestudios
     */
    public function setCama($cama)
    {
        $this->cama = $cama;

        return $this;
    }

    /**
     * Get cama
     *
     * @return integer
     */
    public function getCama()
    {
        return $this->cama;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     * @return SecSolicitudestudios
     */
    public function setIdAtencion(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion = null)
    {
        $this->idAtencion = $idAtencion;

        return $this;
    }

    /**
     * Get idAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    /**
     * Set idDatoReferencia
     *
     * @param \Minsal\LaboratorioBundle\Entity\MntDatoReferencia $idDatoReferencia
     * @return SecSolicitudestudios
     */
    public function setIdDatoReferencia(\Minsal\LaboratorioBundle\Entity\MntDatoReferencia $idDatoReferencia = null)
    {
        $this->idDatoReferencia = $idDatoReferencia;

        return $this;
    }

    /**
     * Get idDatoReferencia
     *
     * @return \Minsal\LaboratorioBundle\Entity\MntDatoReferencia
     */
    public function getIdDatoReferencia()
    {
        return $this->idDatoReferencia;
    }

    /**
     * Set idEstablecimientoExterno
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoExterno
     * @return SecSolicitudestudios
     */
    public function setIdEstablecimientoExterno(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoExterno = null)
    {
        $this->idEstablecimientoExterno = $idEstablecimientoExterno;

        return $this;
    }

    /**
     * Get idEstablecimientoExterno
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoExterno()
    {
        return $this->idEstablecimientoExterno;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return SecSolicitudestudios
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
     * Set estado
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico $estado
     * @return SecSolicitudestudios
     */
    public function setEstado(\Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return SecSolicitudestudios
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return SecSolicitudestudios
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
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecSolicitudestudios
     */
    public function setIdHistorialClinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico = null)
    {
        $this->idHistorialClinico = $idHistorialClinico;

        return $this;
    }

    /**
     * Get idHistorialClinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     */
    public function getIdHistorialClinico()
    {
        return $this->idHistorialClinico;
    }

    /**
     * Set idtiposolicitud
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabTiposolicitud $idtiposolicitud
     * @return SecSolicitudestudios
     */
    public function setIdtiposolicitud(\Minsal\LaboratorioBundle\Entity\LabTiposolicitud $idtiposolicitud = null)
    {
        $this->idtiposolicitud = $idtiposolicitud;

        return $this;
    }

    /**
     * Get idtiposolicitud
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabTiposolicitud
     */
    public function getIdtiposolicitud()
    {
        return $this->idtiposolicitud;
    }

    public function __toString() {
        return (string) $this->id ? $this->id : '';
    }

    /*Funciones de Laboratorio*/
    public function getNombreEmpleado() {
        if($this->idHistorialClinico !== null) {
            $nombreEmpleado = $this->getIdHistorialClinico()->getIdEmpleado()->getNombreempleado();
        } else {
            $nombreEmpleado = $this->getIdDatoReferencia()->getIdEmpleado()->getNombreempleado();
        }

        return $nombreEmpleado;
    }

    public function getNombreEspecialidad() {
        if($this->idHistorialClinico !== null) {
            $nombreEspecialidad = $this->getIdHistorialClinico()->getIdAtenAreaModEstab()->getIdAtencion()->getNombre();
        } else {
            $nombreEspecialidad = $this->getIdDatoReferencia()->getIdAtenAreaModEstab()->getIdAtencion()->getNombre();
        }

        return $nombreEspecialidad;
    }

    public function getNumeroExpediente() {
        if($this->idHistorialClinico !== null) {
            $nombreEspecialidad = $this->getIdHistorialClinico()->getIdExpediente()->getNumero();
        } else {
            $nombreEspecialidad = $this->getIdDatoReferencia()->getIdExpedienteReferido()->getNumero();
        }

        return $nombreEspecialidad;
    }

    public function getNombrePaciente() {
        if($this->idHistorialClinico !== null) {
            $nombreEspecialidad = $this->getIdHistorialClinico()->getIdExpediente()->getIdPaciente()->getNombrePaciente();
        } else {
            $nombreEspecialidad = $this->getIdDatoReferencia()->getIdExpedienteReferido()->getIdReferido()->getNombrePaciente();
        }

        return $nombreEspecialidad;
    }
    /*Fin Funciones de Laboratorio*/
}
