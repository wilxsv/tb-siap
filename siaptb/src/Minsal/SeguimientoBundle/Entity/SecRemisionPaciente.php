<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecRemisionPaciente
 *
 * @ORM\Table(name="sec_remision_paciente", indexes={@ORM\Index(name="IDX_633C28F731827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_633C28F76C9F6C38", columns={"id_tipo_remision"}), @ORM\Index(name="IDX_633C28F76F82FDC3", columns={"id_motivo_remision"})})
 * @ORM\Entity
 */
class SecRemisionPaciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_remision_paciente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=15, nullable=false)
     */
    private $codigo;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_remision", type="date", nullable=false)
     */
    private $fechaRemision;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_expediente", type="string", length=12, nullable=true)
     */
    private $numeroExpediente;

    /**
    * @var \Minsal\SiapsBundle\CtlEstablecimiento
    *
    * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="id_establecimiento_origen", referencedColumnName="id")
    * })
    */
    private $idEstablecimientoOrigen;

    /**
    * @var \Minsal\SiapsBundle\CtlEstablecimiento
    *
    * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="id_establecimiento_destino", referencedColumnName="id")
    * })
    */
    private $idEstablecimientoDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_atend_area_mod_estab_destino", type="integer", nullable=true)
     */
    private $idAtendAreaModEstabDestino;

    /**
    * @var \Minsal\SiapsBundle\CtlAtencion
    *
    * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="id_atencion_destino", referencedColumnName="id")
    * })
    */
    private $idAtencionDestino;

    /**
    * @var \Minsal\SiapsBundle\CtlAtencion
    *
    * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="id_atencion_origen", referencedColumnName="id")
    * })
    */
    private $idAtencionOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="impresion_diagnostica", type="text", nullable=true)
     */
    private $impresionDiagnostica;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_remision", type="text", nullable=true)
     */
    private $justificacionRemision;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_examen", type="text", nullable=true)
     */
    private $datosExamen;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_resultado", type="text", nullable=true)
     */
    private $observacionResultado;

    /**
     * @var string
     *
     * @ORM\Column(name="tratamiento", type="text", nullable=true)
     */
    private $tratamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_paciente_referido", type="integer", nullable=true)
     */
    private $idPacienteReferido;

     /**
     * @var integer
     *
     * @ORM\Column(name="id_historial_clinico", type="integer", nullable=true)
     */
    private $idHistorialClinico;

    /**
     * @var \CtlTipoRemision
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoRemision")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_remision", referencedColumnName="id")
     * })
     */
    private $idTipoRemision;

    /**
     * @var \CtlMotivoRemision
     *
     * @ORM\ManyToOne(targetEntity="CtlMotivoRemision")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo_remision", referencedColumnName="id")
     * })
     */
    private $idMotivoRemision;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_medico", type="text", nullable=true)
     */
    private $nombreMedico;



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
     * Set codigo
     *
     * @param string $codigo
     * @return SecRemisionPaciente
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set fechaRemision
     *
     * @param \DateTime $fechaRemision
     * @return SecRemisionPaciente
     */
    public function setFechaRemision($fechaRemision)
    {
        $this->fechaRemision = $fechaRemision;

        return $this;
    }

    /**
     * Get fechaRemision
     *
     * @return \DateTime
     */
    public function getFechaRemision()
    {
        return $this->fechaRemision;
    }

    /**
     * Set numeroExpediente
     *
     * @param string $numeroExpediente
     * @return SecRemisionPaciente
     */
    public function setNumeroExpediente($numeroExpediente)
    {
        $this->numeroExpediente = $numeroExpediente;

        return $this;
    }

    /**
     * Get numeroExpediente
     *
     * @return string
     */
    public function getNumeroExpediente()
    {
        return $this->numeroExpediente;
    }


    /**
     * Set impresionDiagnostica
     *
     * @param string $impresionDiagnostica
     * @return SecRemisionPaciente
     */
    public function setImpresionDiagnostica($impresionDiagnostica)
    {
        $this->impresionDiagnostica = $impresionDiagnostica;

        return $this;
    }

    /**
     * Get impresionDiagnostica
     *
     * @return string
     */
    public function getImpresionDiagnostica()
    {
        return $this->impresionDiagnostica;
    }

    /**
     * Set justificacionRemision
     *
     * @param string $justificacionRemision
     * @return SecRemisionPaciente
     */
    public function setJustificacionRemision($justificacionRemision)
    {
        $this->justificacionRemision = $justificacionRemision;

        return $this;
    }

    /**
     * Get justificacionRemision
     *
     * @return string
     */
    public function getJustificacionRemision()
    {
        return $this->justificacionRemision;
    }

    /**
     * Set datosExamen
     *
     * @param string $datosExamen
     * @return SecRemisionPaciente
     */
    public function setDatosExamen($datosExamen)
    {
        $this->datosExamen = $datosExamen;

        return $this;
    }

    /**
     * Get datosExamen
     *
     * @return string
     */
    public function getDatosExamen()
    {
        return $this->datosExamen;
    }

    /**
     * Set observacionResultado
     *
     * @param string $observacionResultado
     * @return SecRemisionPaciente
     */
    public function setObservacionResultado($observacionResultado)
    {
        $this->observacionResultado = $observacionResultado;

        return $this;
    }

    /**
     * Get observacionResultado
     *
     * @return string
     */
    public function getObservacionResultado()
    {
        return $this->observacionResultado;
    }

    /**
     * Set tratamiento
     *
     * @param string $tratamiento
     * @return SecRemisionPaciente
     */
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return string
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set idHistorialClinico
     *
     * @param integer $idHistorialClinico
     * @return SecRemisionPaciente
     */
    public function setIdHistorialClinico( $idHistorialClinico = null)
    {
        $this->idHistorialClinico = $idHistorialClinico;

        return $this;
    }

    /**
     * Get idHistorialClinico
     *
     * @return integer
     */
    public function getIdHistorialClinico()
    {
        return $this->idHistorialClinico;
    }

    /**
     * Set idTipoRemision
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoRemision $idTipoRemision
     * @return SecRemisionPaciente
     */
    public function setIdTipoRemision(\Minsal\SeguimientoBundle\Entity\CtlTipoRemision $idTipoRemision = null)
    {
        $this->idTipoRemision = $idTipoRemision;

        return $this;
    }

    /**
     * Get idTipoRemision
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoRemision
     */
    public function getIdTipoRemision()
    {
        return $this->idTipoRemision;
    }

    /**
     * Set idMotivoRemision
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlMotivoRemision $idMotivoRemision
     * @return SecRemisionPaciente
     */
    public function setIdMotivoRemision(\Minsal\SeguimientoBundle\Entity\CtlMotivoRemision $idMotivoRemision = null)
    {
        $this->idMotivoRemision = $idMotivoRemision;

        return $this;
    }

    /**
     * Get idMotivoRemision
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlMotivoRemision
     */
    public function getIdMotivoRemision()
    {
        return $this->idMotivoRemision;
    }

     /*Método __toString*/
    public function __toString() {
        return $this->codigo ? : '';
    }

    /**
     * Set idEstablecimientoOrigen
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoOrigen
     * @return SecRemisionPaciente
     */
    public function setIdEstablecimientoOrigen(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoOrigen = null)
    {
        $this->idEstablecimientoOrigen = $idEstablecimientoOrigen;

        return $this;
    }

    /**
     * Get idEstablecimientoOrigen
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoOrigen()
    {
        return $this->idEstablecimientoOrigen;
    }

    /**
     * Set idAtendAreaModEstabDestino
     *
     * @param integer $idAtendAreaModEstabDestino
     * @return SecRemisionPaciente
     */
    public function setIdAtendAreaModEstabDestino($idAtendAreaModEstabDestino)
    {
        $this->idAtendAreaModEstabDestino = $idAtendAreaModEstabDestino;

        return $this;
    }

    /**
     * Get idAtendAreaModEstabDestino
     *
     * @return integer
     */
    public function getIdAtendAreaModEstabDestino()
    {
        return $this->idAtendAreaModEstabDestino;
    }

    /**
     * Set idPacienteReferido
     *
     * @param integer $idPacienteReferido
     * @return SecRemisionPaciente
     */
    public function setIdPacienteReferido($idPacienteReferido)
    {
        $this->idPacienteReferido = $idPacienteReferido;

        return $this;
    }

    /**
     * Get idPacienteReferido
     *
     * @return integer
     */
    public function getIdPacienteReferido()
    {
        return $this->idPacienteReferido;
    }

    /**
     * Set nombreMedico
     *
     * @param string $nombreMedico
     * @return SecRemisionPaciente
     */
    public function setNombreMedico($nombreMedico)
    {
        $this->nombreMedico = $nombreMedico;

        return $this;
    }

    /**
     * Get nombreMedico
     *
     * @return string
     */
    public function getNombreMedico()
    {
        return $this->nombreMedico;
    }

    /**
     * Set idAtencionDestino
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencionDestino
     * @return SecRemisionPaciente
     */
    public function setIdAtencionDestino(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencionDestino = null)
    {
        $this->idAtencionDestino = $idAtencionDestino;

        return $this;
    }

    /**
     * Get idAtencionDestino
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencionDestino()
    {
        return $this->idAtencionDestino;
    }

    /**
     * Set idAtencionOrigen
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencionOrigen
     * @return SecRemisionPaciente
     */
    public function setIdAtencionOrigen(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencionOrigen = null)
    {
        $this->idAtencionOrigen = $idAtencionOrigen;

        return $this;
    }

    /**
     * Get idAtencionOrigen
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencionOrigen()
    {
        return $this->idAtencionOrigen;
    }

    /**
     * Set idEstablecimientoDestino
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoDestino
     * @return SecRemisionPaciente
     */
    public function setIdEstablecimientoDestino(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoDestino = null)
    {
        $this->idEstablecimientoDestino = $idEstablecimientoDestino;

        return $this;
    }

    /**
     * Get idEstablecimientoDestino
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoDestino()
    {
        return $this->idEstablecimientoDestino;
    }
}
