<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSolicitudQuirurgica
 *
 * @ORM\Table(name="sec_solicitud_quirurgica", indexes={@ORM\Index(name="IDX_3527F8231827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_3527F82A42231CC", columns={"id_manejo_cirugia"}), @ORM\Index(name="IDX_3527F825F193BFE", columns={"id_prioridad_cirugia"}), @ORM\Index(name="IDX_3527F8287B45C92", columns={"id_grado_complejidad_quirurgica"}), @ORM\Index(name="IDX_3527F82CAE272A7", columns={"id_riesgo_anestesico"}), @ORM\Index(name="IDX_3527F82A7C48DCA", columns={"id_estado_solicitud_quirurgica"}), @ORM\Index(name="IDX_3527F82890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_3527F82FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class SecSolicitudQuirurgica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_solicitud_quirurgica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_quirurgico_estimado", type="text", nullable=true)
     */
    private $tiempoQuirurgicoEstimado;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="solicitud_materiales", type="text", nullable=true)
     */
    private $solicitudMateriales;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'seconds';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=false)
     */
    private $fechaHoraRegistro = 'seconds';

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
     * @var \TarDatosManejo
     *
     * @ORM\ManyToOne(targetEntity="TarDatosManejo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_manejo_cirugia", referencedColumnName="id")
     * })
     */
    private $idManejoCirugia;

    /**
     * @var \CtlPrioridadCirugia
     *
     * @ORM\ManyToOne(targetEntity="CtlPrioridadCirugia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prioridad_cirugia", referencedColumnName="id")
     * })
     */
    private $idPrioridadCirugia;

    /**
     * @var \CtlGradoComplejidadQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="CtlGradoComplejidadQuirurgica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grado_complejidad_quirurgica", referencedColumnName="id")
     * })
     */
    private $idGradoComplejidadQuirurgica;

    /**
     * @var \CtlRiesgoAnestesico
     *
     * @ORM\ManyToOne(targetEntity="CtlRiesgoAnestesico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_riesgo_anestesico", referencedColumnName="id")
     * })
     */
    private $idRiesgoAnestesico;

    /**
     * @var \CtlEstadoSolicitudQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="CtlEstadoSolicitudQuirurgica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_solicitud_quirurgica", referencedColumnName="id")
     * })
     */
    private $idEstadoSolicitudQuirurgica;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;

    /**
     *
     * @ORM\OneToMany(targetEntity="SecSolicitudQuirurgicaProcedimiento", mappedBy="idSolicitudQuirurgica", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $procedimientoQuirurgico;

    /**
     *
     * @ORM\OneToMany(targetEntity="SecSolicitudQuirurgicaAptitud", mappedBy="idSolicitudQuirurgica", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $aptitudQuirurgica;

    /**
     *
     * @ORM\OneToMany(targetEntity="SecSolicitudQuirurgicaTipoAnestesia", mappedBy="idSolicitudQuirurgica", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $tipoAnestesia;


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
     * Set tiempoQuirurgicoEstimado
     *
     * @param string $tiempoQuirurgicoEstimado
     * @return SecSolicitudQuirurgica
     */
    public function setTiempoQuirurgicoEstimado($tiempoQuirurgicoEstimado)
    {
        $this->tiempoQuirurgicoEstimado = $tiempoQuirurgicoEstimado;

        return $this;
    }

    /**
     * Get tiempoQuirurgicoEstimado
     *
     * @return string
     */
    public function getTiempoQuirurgicoEstimado()
    {
        return $this->tiempoQuirurgicoEstimado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return SecSolicitudQuirurgica
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set solicitudMateriales
     *
     * @param string $solicitudMateriales
     * @return SecSolicitudQuirurgica
     */
    public function setSolicitudMateriales($solicitudMateriales)
    {
        $this->solicitudMateriales = $solicitudMateriales;

        return $this;
    }

    /**
     * Get solicitudMateriales
     *
     * @return string
     */
    public function getSolicitudMateriales()
    {
        return $this->solicitudMateriales;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return SecSolicitudQuirurgica
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
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return SecSolicitudQuirurgica
     */
    public function setFechaHoraRegistro($fechaHoraRegistro)
    {
        $this->fechaHoraRegistro = $fechaHoraRegistro;

        return $this;
    }

    /**
     * Get fechaHoraRegistro
     *
     * @return \DateTime
     */
    public function getFechaHoraRegistro()
    {
        return $this->fechaHoraRegistro;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecSolicitudQuirurgica
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
     * Set idManejoCirugia
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarDatosManejo $idManejoCirugia
     * @return SecSolicitudQuirurgica
     */
    public function setIdManejoCirugia(\Minsal\SeguimientoBundle\Entity\TarDatosManejo $idManejoCirugia = null)
    {
        $this->idManejoCirugia = $idManejoCirugia;

        return $this;
    }

    /**
     * Get idManejoCirugia
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarDatosManejo
     */
    public function getIdManejoCirugia()
    {
        return $this->idManejoCirugia;
    }

    /**
     * Set idPrioridadCirugia
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlPrioridadCirugia $idPrioridadCirugia
     * @return SecSolicitudQuirurgica
     */
    public function setIdPrioridadCirugia(\Minsal\SeguimientoBundle\Entity\CtlPrioridadCirugia $idPrioridadCirugia = null)
    {
        $this->idPrioridadCirugia = $idPrioridadCirugia;

        return $this;
    }

    /**
     * Get idPrioridadCirugia
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlPrioridadCirugia
     */
    public function getIdPrioridadCirugia()
    {
        return $this->idPrioridadCirugia;
    }

    /**
     * Set idGradoComplejidadQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlGradoComplejidadQuirurgica $idGradoComplejidadQuirurgica
     * @return SecSolicitudQuirurgica
     */
    public function setIdGradoComplejidadQuirurgica(\Minsal\SeguimientoBundle\Entity\CtlGradoComplejidadQuirurgica $idGradoComplejidadQuirurgica = null)
    {
        $this->idGradoComplejidadQuirurgica = $idGradoComplejidadQuirurgica;

        return $this;
    }

    /**
     * Get idGradoComplejidadQuirurgica
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlGradoComplejidadQuirurgica
     */
    public function getIdGradoComplejidadQuirurgica()
    {
        return $this->idGradoComplejidadQuirurgica;
    }

    /**
     * Set idRiesgoAnestesico
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlRiesgoAnestesico $idRiesgoAnestesico
     * @return SecSolicitudQuirurgica
     */
    public function setIdRiesgoAnestesico(\Minsal\SeguimientoBundle\Entity\CtlRiesgoAnestesico $idRiesgoAnestesico = null)
    {
        $this->idRiesgoAnestesico = $idRiesgoAnestesico;

        return $this;
    }

    /**
     * Get idRiesgoAnestesico
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlRiesgoAnestesico
     */
    public function getIdRiesgoAnestesico()
    {
        return $this->idRiesgoAnestesico;
    }

    /**
     * Set idEstadoSolicitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlEstadoSolicitudQuirurgica $idEstadoSolicitudQuirurgica
     * @return SecSolicitudQuirurgica
     */
    public function setIdEstadoSolicitudQuirurgica(\Minsal\SeguimientoBundle\Entity\CtlEstadoSolicitudQuirurgica $idEstadoSolicitudQuirurgica = null)
    {
        $this->idEstadoSolicitudQuirurgica = $idEstadoSolicitudQuirurgica;

        return $this;
    }

    /**
     * Get idEstadoSolicitudQuirurgica
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlEstadoSolicitudQuirurgica
     */
    public function getIdEstadoSolicitudQuirurgica()
    {
        return $this->idEstadoSolicitudQuirurgica;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return SecSolicitudQuirurgica
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
     * Set idUsuario
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuario
     * @return SecSolicitudQuirurgica
     */
    public function setIdUsuario(\Application\Sonata\UserBundle\Entity\User $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->procedimientoQuirurgico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->aptitudQuirurgica = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tipoAnestesia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add procedimientoQuirurgico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaProcedimiento $procedimientoQuirurgico
     * @return SecSolicitudQuirurgica
     */
    public function addProcedimientoQuirurgico(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaProcedimiento $procedimientoQuirurgico)
    {
        $this->procedimientoQuirurgico[] = $procedimientoQuirurgico;

        return $this;
    }

    /**
     * Remove procedimientoQuirurgico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaProcedimiento $procedimientoQuirurgico
     */
    public function removeProcedimientoQuirurgico(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaProcedimiento $procedimientoQuirurgico)
    {
        $this->procedimientoQuirurgico->removeElement($procedimientoQuirurgico);
    }

    /**
     * Get procedimientoQuirurgico
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcedimientoQuirurgico()
    {
        return $this->procedimientoQuirurgico;
    }

    /**
     * Add aptitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaAptitud $aptitudQuirurgica
     * @return SecSolicitudQuirurgica
     */
    public function addAptitudQuirurgica(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaAptitud $aptitudQuirurgica)
    {
        $this->aptitudQuirurgica[] = $aptitudQuirurgica;

        return $this;
    }

    /**
     * Remove aptitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaAptitud $aptitudQuirurgica
     */
    public function removeAptitudQuirurgica(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaAptitud $aptitudQuirurgica)
    {
        $this->aptitudQuirurgica->removeElement($aptitudQuirurgica);
    }

    /**
     * Get aptitudQuirurgica
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAptitudQuirurgica()
    {
        return $this->aptitudQuirurgica;
    }

    /**
     * Add tipoAnestesia
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaTipoAnestesia $tipoAnestesia
     * @return SecSolicitudQuirurgica
     */
    public function addTipoAnestesium(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaTipoAnestesia $tipoAnestesia)
    {
        $this->tipoAnestesia[] = $tipoAnestesia;

        return $this;
    }

    /**
     * Remove tipoAnestesia
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaTipoAnestesia $tipoAnestesia
     */
    public function removeTipoAnestesium(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgicaTipoAnestesia $tipoAnestesia)
    {
        $this->tipoAnestesia->removeElement($tipoAnestesia);
    }

    /**
     * Get tipoAnestesia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTipoAnestesia()
    {
        return $this->tipoAnestesia;
    }

    public function __toString(){
        return $this->id ? $this->id.'' : '';
    }
}
