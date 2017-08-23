<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Minsal\SeguimientoBundle\Entity\SecSolicitudestudios;

/**
 * SecDetallesolicitudestudios
 *
 * @ORM\Table(name="sec_detallesolicitudestudios", indexes={@ORM\Index(name="IDX_B983B70C271DEBD7", columns={"id_conf_examen_estab"}), @ORM\Index(name="IDX_B983B70C5C87B81E", columns={"idestablecimientoenvio"}), @ORM\Index(name="IDX_B983B70C730CF75F", columns={"idempleado"}), @ORM\Index(name="IDX_B983B70C75BB31F7", columns={"idestablecimiento"}), @ORM\Index(name="IDX_B983B70C87364D84", columns={"idestablecimientoexterno"}), @ORM\Index(name="IDX_B983B70C2AB3F305", columns={"estadodetalle"}), @ORM\Index(name="IDX_B983B70CC05D0C91", columns={"id_estado_rechazo"}), @ORM\Index(name="IDX_B983B70C35F12240", columns={"idexamen"}), @ORM\Index(name="IDX_B983B70C13B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_B983B70CB1B94CA1", columns={"idorigenmuestra"}), @ORM\Index(name="IDX_B983B70C5410CD68", columns={"id_posible_observacion"}), @ORM\Index(name="IDX_B983B70CF06DFE3D", columns={"idsolicitudestudio"}), @ORM\Index(name="IDX_B983B70CDAB57264", columns={"idtipomuestra"}), @ORM\Index(name="IDX_B983B70C9E450DCD", columns={"id_suministrante"})})
 * @ORM\Entity(repositoryClass="Minsal\SeguimientoBundle\Repositorio\SecDetallesolicitudestudiosRepository")
 */
class SecDetallesolicitudestudios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_detallesolicitudestudios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="indicacion", type="string", length=250, nullable=true)
     */
    private $indicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="date", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="f_tomamuestra", type="datetime", nullable=true)
     */
    private $fTomamuestra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="f_estado", type="date", nullable=true)
     */
    private $fEstado;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabConfExamenEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conf_examen_estab", referencedColumnName="id")
     * })
     */
    private $idConfExamenEstab;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimientoenvio", referencedColumnName="id")
     * })
     */
    private $idestablecimientoenvio;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idempleado", referencedColumnName="id")
     * })
     */
    private $idempleado;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="\Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimientoexterno", referencedColumnName="id")
     * })
     */
    private $idestablecimientoexterno;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadodetalle", referencedColumnName="id")
     * })
     */
    private $estadodetalle;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\LabEstadoRechazo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabEstadoRechazo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_rechazo", referencedColumnName="id")
     * })
     */
    private $idEstadoRechazo;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\MntAreaExamenEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idexamen", referencedColumnName="id")
     * })
     */
    private $idexamen;

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
     * @var \Minsal\LaboratorioBundle\Entity\MntOrigenmuestra
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\MntOrigenmuestra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idorigenmuestra", referencedColumnName="id")
     * })
     */
    private $idorigenmuestra;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\LabPosibleObservacion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabPosibleObservacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_posible_observacion", referencedColumnName="id")
     * })
     */
    private $idPosibleObservacion;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecSolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsolicitudestudio", referencedColumnName="id")
     * })
     */
    private $idsolicitudestudio;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\LabTipomuestra
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabTipomuestra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtipomuestra", referencedColumnName="id")
     * })
     */
    private $idtipomuestra;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\LabSuministrante
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabSuministrante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_suministrante", referencedColumnName="id")
     * })
     */
    private $idSuministrante;



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
     * Set indicacion
     *
     * @param string $indicacion
     * @return SecDetallesolicitudestudios
     */
    public function setIndicacion($indicacion)
    {
        $this->indicacion = $indicacion;

        return $this;
    }

    /**
     * Get indicacion
     *
     * @return string
     */
    public function getIndicacion()
    {
        return $this->indicacion;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return SecDetallesolicitudestudios
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return SecDetallesolicitudestudios
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
     * Set fTomamuestra
     *
     * @param \DateTime $fTomamuestra
     * @return SecDetallesolicitudestudios
     */
    public function setFTomamuestra($fTomamuestra)
    {
        $this->fTomamuestra = $fTomamuestra;

        return $this;
    }

    /**
     * Get fTomamuestra
     *
     * @return \DateTime
     */
    public function getFTomamuestra()
    {
        return $this->fTomamuestra;
    }

    /**
     * Set fEstado
     *
     * @param \DateTime $fEstado
     * @return SecDetallesolicitudestudios
     */
    public function setFEstado($fEstado)
    {
        $this->fEstado = $fEstado;

        return $this;
    }

    /**
     * Get fEstado
     *
     * @return \DateTime
     */
    public function getFEstado()
    {
        return $this->fEstado;
    }

    /**
     * Set idConfExamenEstab
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idConfExamenEstab
     * @return SecDetallesolicitudestudios
     */
    public function setIdConfExamenEstab(\Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idConfExamenEstab = null)
    {
        $this->idConfExamenEstab = $idConfExamenEstab;

        return $this;
    }

    /**
     * Get idConfExamenEstab
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab
     */
    public function getIdConfExamenEstab()
    {
        return $this->idConfExamenEstab;
    }

    /**
     * Set idestablecimientoenvio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoenvio
     * @return SecDetallesolicitudestudios
     */
    public function setIdestablecimientoenvio(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoenvio = null)
    {
        $this->idestablecimientoenvio = $idestablecimientoenvio;

        return $this;
    }

    /**
     * Get idestablecimientoenvio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdestablecimientoenvio()
    {
        return $this->idestablecimientoenvio;
    }

    /**
     * Set idempleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idempleado
     * @return SecDetallesolicitudestudios
     */
    public function setIdempleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idempleado = null)
    {
        $this->idempleado = $idempleado;

        return $this;
    }

    /**
     * Get idempleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdempleado()
    {
        return $this->idempleado;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return SecDetallesolicitudestudios
     */
    public function setIdestablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento = null)
    {
        $this->idestablecimiento = $idestablecimiento;

        return $this;
    }

    /**
     * Get idestablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdestablecimiento()
    {
        return $this->idestablecimiento;
    }

    /**
     * Set idestablecimientoexterno
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoexterno
     * @return SecDetallesolicitudestudios
     */
    public function setIdestablecimientoexterno(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoexterno = null)
    {
        $this->idestablecimientoexterno = $idestablecimientoexterno;

        return $this;
    }

    /**
     * Get idestablecimientoexterno
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdestablecimientoexterno()
    {
        return $this->idestablecimientoexterno;
    }

    /**
     * Set estadodetalle
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico $estadodetalle
     * @return SecDetallesolicitudestudios
     */
    public function setEstadodetalle(\Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico $estadodetalle = null)
    {
        $this->estadodetalle = $estadodetalle;

        return $this;
    }

    /**
     * Get estadodetalle
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlEstadoServicioDiagnostico
     */
    public function getEstadodetalle()
    {
        return $this->estadodetalle;
    }

    /**
     * Set idEstadoRechazo
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabEstadoRechazo $idEstadoRechazo
     * @return SecDetallesolicitudestudios
     */
    public function setIdEstadoRechazo(\Minsal\LaboratorioBundle\Entity\LabEstadoRechazo $idEstadoRechazo = null)
    {
        $this->idEstadoRechazo = $idEstadoRechazo;

        return $this;
    }

    /**
     * Get idEstadoRechazo
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabEstadoRechazo
     */
    public function getIdEstadoRechazo()
    {
        return $this->idEstadoRechazo;
    }

    /**
     * Set idexamen
     *
     * @param \Minsal\LaboratorioBundle\Entity\MntAreaExamenEstablecimiento $idexamen
     * @return SecDetallesolicitudestudios
     */
    public function setIdexamen(\Minsal\LaboratorioBundle\Entity\MntAreaExamenEstablecimiento $idexamen = null)
    {
        $this->idexamen = $idexamen;

        return $this;
    }

    /**
     * Get idexamen
     *
     * @return \Minsal\LaboratorioBundle\Entity\MntAreaExamenEstablecimiento
     */
    public function getIdexamen()
    {
        return $this->idexamen;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return SecDetallesolicitudestudios
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
     * Set idorigenmuestra
     *
     * @param \Minsal\LaboratorioBundle\Entity\MntOrigenmuestra $idorigenmuestra
     * @return SecDetallesolicitudestudios
     */
    public function setIdorigenmuestra(\Minsal\LaboratorioBundle\Entity\MntOrigenmuestra $idorigenmuestra = null)
    {
        $this->idorigenmuestra = $idorigenmuestra;

        return $this;
    }

    /**
     * Get idorigenmuestra
     *
     * @return \Minsal\LaboratorioBundle\Entity\MntOrigenmuestra
     */
    public function getIdorigenmuestra()
    {
        return $this->idorigenmuestra;
    }

    /**
     * Set idPosibleObservacion
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPosibleObservacion $idPosibleObservacion
     * @return SecDetallesolicitudestudios
     */
    public function setIdPosibleObservacion(\Minsal\LaboratorioBundle\Entity\LabPosibleObservacion $idPosibleObservacion = null)
    {
        $this->idPosibleObservacion = $idPosibleObservacion;

        return $this;
    }

    /**
     * Get idPosibleObservacion
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPosibleObservacion
     */
    public function getIdPosibleObservacion()
    {
        return $this->idPosibleObservacion;
    }

    /**
     * Set idsolicitudestudio
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idsolicitudestudio
     * @return SecDetallesolicitudestudios
     */
    public function setIdsolicitudestudio(\Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idsolicitudestudio = null)
    {
        $this->idsolicitudestudio = $idsolicitudestudio;

        return $this;
    }

    /**
     * Get idsolicitudestudio
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios
     */
    public function getIdsolicitudestudio()
    {
        return $this->idsolicitudestudio;
    }

    /**
     * Set idtipomuestra
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabTipomuestra $idtipomuestra
     * @return SecDetallesolicitudestudios
     */
    public function setIdtipomuestra(\Minsal\LaboratorioBundle\Entity\LabTipomuestra $idtipomuestra = null)
    {
        $this->idtipomuestra = $idtipomuestra;

        return $this;
    }

    /**
     * Get idtipomuestra
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabTipomuestra
     */
    public function getIdtipomuestra()
    {
        return $this->idtipomuestra;
    }

    /**
     * Set idSuministrante
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabSuministrante $idSuministrante
     * @return SecDetallesolicitudestudios
     */
    public function setIdSuministrante(\Minsal\LaboratorioBundle\Entity\LabSuministrante $idSuministrante = null)
    {
        $this->idSuministrante = $idSuministrante;

        return $this;
    }

    /**
     * Get idSuministrante
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabSuministrante
     */
    public function getIdSuministrante()
    {
        return $this->idSuministrante;
    }
}
