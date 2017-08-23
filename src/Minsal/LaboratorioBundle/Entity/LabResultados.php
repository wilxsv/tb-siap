<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabResultados
 *
 * @ORM\Table(name="lab_resultados", indexes={@ORM\Index(name="IDX_67576A8635F12240", columns={"idexamen"}), @ORM\Index(name="IDX_67576A86F4D2E8F0", columns={"iddetallesolicitud"}), @ORM\Index(name="IDX_67576A86730CF75F", columns={"idempleado"}), @ORM\Index(name="IDX_67576A8675BB31F7", columns={"idestablecimiento"}), @ORM\Index(name="IDX_67576A866724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_67576A8613B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_67576A8610AA7931", columns={"id_observacion"}), @ORM\Index(name="IDX_67576A8619211949", columns={"id_posible_resultado"}), @ORM\Index(name="IDX_67576A86D986AF39", columns={"idrecepcionmuestra"}), @ORM\Index(name="IDX_67576A86F06DFE3D", columns={"idsolicitudestudio"}), @ORM\Index(name="IDX_67576A86EA165508", columns={"idestablecimiento_realizo"})})
 * @ORM\Entity
 */
class LabResultados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_resultados_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=250, nullable=true)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="lectura", type="string", length=100, nullable=true)
     */
    private $lectura;

    /**
     * @var string
     *
     * @ORM\Column(name="interpretacion", type="string", length=100, nullable=true)
     */
    private $interpretacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_resultado", type="datetime", nullable=false)
     */
    private $fechaResultado;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=150, nullable=true)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_empleado", type="string", length=150, nullable=true)
     */
    private $nombreEmpleado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_resultado_padre", type="integer", nullable=true)
     */
    private $idResultadoPadre;

    /**
     * @var \LabConfExamenEstab
     *
     * @ORM\ManyToOne(targetEntity="LabConfExamenEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idexamen", referencedColumnName="id")
     * })
     */
    private $idexamen;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iddetallesolicitud", referencedColumnName="id")
     * })
     */
    private $iddetallesolicitud;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

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
     * @var \LabObservaciones
     *
     * @ORM\ManyToOne(targetEntity="LabObservaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_observacion", referencedColumnName="id")
     * })
     */
    private $idObservacion;

    /**
     * @var \LabPosibleResultado
     *
     * @ORM\ManyToOne(targetEntity="LabPosibleResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_posible_resultado", referencedColumnName="id")
     * })
     */
    private $idPosibleResultado;

    /**
     * @var \LabRecepcionmuestra
     *
     * @ORM\ManyToOne(targetEntity="LabRecepcionmuestra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idrecepcionmuestra", referencedColumnName="id")
     * })
     */
    private $idrecepcionmuestra;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento_realizo", referencedColumnName="id")
     * })
     */
    private $idestablecimientoRealizo;



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
     * Set resultado
     *
     * @param string $resultado
     * @return LabResultados
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set lectura
     *
     * @param string $lectura
     * @return LabResultados
     */
    public function setLectura($lectura)
    {
        $this->lectura = $lectura;

        return $this;
    }

    /**
     * Get lectura
     *
     * @return string 
     */
    public function getLectura()
    {
        return $this->lectura;
    }

    /**
     * Set interpretacion
     *
     * @param string $interpretacion
     * @return LabResultados
     */
    public function setInterpretacion($interpretacion)
    {
        $this->interpretacion = $interpretacion;

        return $this;
    }

    /**
     * Get interpretacion
     *
     * @return string 
     */
    public function getInterpretacion()
    {
        return $this->interpretacion;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return LabResultados
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
     * @return LabResultados
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
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return LabResultados
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
     * Set fechaResultado
     *
     * @param \DateTime $fechaResultado
     * @return LabResultados
     */
    public function setFechaResultado($fechaResultado)
    {
        $this->fechaResultado = $fechaResultado;

        return $this;
    }

    /**
     * Get fechaResultado
     *
     * @return \DateTime 
     */
    public function getFechaResultado()
    {
        return $this->fechaResultado;
    }

    /**
     * Set marca
     *
     * @param string $marca
     * @return LabResultados
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set nombreEmpleado
     *
     * @param string $nombreEmpleado
     * @return LabResultados
     */
    public function setNombreEmpleado($nombreEmpleado)
    {
        $this->nombreEmpleado = $nombreEmpleado;

        return $this;
    }

    /**
     * Get nombreEmpleado
     *
     * @return string 
     */
    public function getNombreEmpleado()
    {
        return $this->nombreEmpleado;
    }

    /**
     * Set idResultadoPadre
     *
     * @param integer $idResultadoPadre
     * @return LabResultados
     */
    public function setIdResultadoPadre($idResultadoPadre)
    {
        $this->idResultadoPadre = $idResultadoPadre;

        return $this;
    }

    /**
     * Get idResultadoPadre
     *
     * @return integer 
     */
    public function getIdResultadoPadre()
    {
        return $this->idResultadoPadre;
    }

    /**
     * Set idexamen
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idexamen
     * @return LabResultados
     */
    public function setIdexamen(\Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idexamen = null)
    {
        $this->idexamen = $idexamen;

        return $this;
    }

    /**
     * Get idexamen
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab 
     */
    public function getIdexamen()
    {
        return $this->idexamen;
    }

    /**
     * Set iddetallesolicitud
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios $iddetallesolicitud
     * @return LabResultados
     */
    public function setIddetallesolicitud(\Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios $iddetallesolicitud = null)
    {
        $this->iddetallesolicitud = $iddetallesolicitud;

        return $this;
    }

    /**
     * Get iddetallesolicitud
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios 
     */
    public function getIddetallesolicitud()
    {
        return $this->iddetallesolicitud;
    }

    /**
     * Set idempleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idempleado
     * @return LabResultados
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
     * @return LabResultados
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
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return LabResultados
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return LabResultados
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
     * Set idObservacion
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabObservaciones $idObservacion
     * @return LabResultados
     */
    public function setIdObservacion(\Minsal\LaboratorioBundle\Entity\LabObservaciones $idObservacion = null)
    {
        $this->idObservacion = $idObservacion;

        return $this;
    }

    /**
     * Get idObservacion
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabObservaciones 
     */
    public function getIdObservacion()
    {
        return $this->idObservacion;
    }

    /**
     * Set idPosibleResultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosibleResultado
     * @return LabResultados
     */
    public function setIdPosibleResultado(\Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosibleResultado = null)
    {
        $this->idPosibleResultado = $idPosibleResultado;

        return $this;
    }

    /**
     * Get idPosibleResultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPosibleResultado 
     */
    public function getIdPosibleResultado()
    {
        return $this->idPosibleResultado;
    }

    /**
     * Set idrecepcionmuestra
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabRecepcionmuestra $idrecepcionmuestra
     * @return LabResultados
     */
    public function setIdrecepcionmuestra(\Minsal\LaboratorioBundle\Entity\LabRecepcionmuestra $idrecepcionmuestra = null)
    {
        $this->idrecepcionmuestra = $idrecepcionmuestra;

        return $this;
    }

    /**
     * Get idrecepcionmuestra
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabRecepcionmuestra 
     */
    public function getIdrecepcionmuestra()
    {
        return $this->idrecepcionmuestra;
    }

    /**
     * Set idsolicitudestudio
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idsolicitudestudio
     * @return LabResultados
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
     * Set idestablecimientoRealizo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoRealizo
     * @return LabResultados
     */
    public function setIdestablecimientoRealizo(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoRealizo = null)
    {
        $this->idestablecimientoRealizo = $idestablecimientoRealizo;

        return $this;
    }

    /**
     * Get idestablecimientoRealizo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdestablecimientoRealizo()
    {
        return $this->idestablecimientoRealizo;
    }
}
