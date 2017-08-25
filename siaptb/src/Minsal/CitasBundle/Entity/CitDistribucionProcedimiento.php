<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitDistribucionProcedimiento
 *
 * @ORM\Table(name="cit_distribucion_procedimiento", indexes={@ORM\Index(name="IDX_86A30C51EB971272", columns={"id_rangohora"}), @ORM\Index(name="IDX_86A30C51890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_86A30C51CC2F8715", columns={"id_area_mod_estab"}), @ORM\Index(name="IDX_86A30C5113B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_86A30C516724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_86A30C51D893921F", columns={"id_procedimiento_establecimiento"})})
 * @ORM\Entity
 */
class CitDistribucionProcedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_distribucion_procedimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cupos", type="integer", nullable=false)
     */
    private $cupos;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_citas_agregadas", type="integer", nullable=false)
     */
    private $maxCitasAgregadas = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_lectura_dias", type="integer", nullable=false)
     */
    private $tiempoLecturaDias;

    /**
     * @var integer
     *
     * @ORM\Column(name="dia", type="integer", nullable=false)
     */
    private $dia;

    /**
     * @var integer
     *
     * @ORM\Column(name="mes", type="integer", nullable=false)
     */
    private $mes;

    /**
     * @var integer
     *
     * @ORM\Column(name="yrs", type="integer", nullable=false)
     */
    private $yrs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=false)
     */
    private $fechahorareg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntRangohora
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntRangohora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rangohora", referencedColumnName="id")
     * })
     */
    private $idRangohora;

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
     * @var \Minsal\SiapsBundle\Entity\MntAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAreaModEstab;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_establecimiento", referencedColumnName="id")
     * })
     */
    private $idProcedimientoEstablecimiento;

    /**
     * @var \Minsal\CitasBundle\Entity\CitEstadoDistribucion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitEstadoDistribucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_distribucion", referencedColumnName="id")
     * })
     */
    private $idEstadoDistribucion;

    /**
     * @var \CitTipoDistribucion
     *
     * @ORM\ManyToOne(targetEntity="CitTipoDistribucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_distribucion", referencedColumnName="id")
     * })
     */
    private $idTipoDistribucion;


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
     * Set cupos
     *
     * @param integer $cupos
     * @return CitDistribucionProcedimiento
     */
    public function setCupos($cupos)
    {
        $this->cupos = $cupos;

        return $this;
    }

    /**
     * Get cupos
     *
     * @return integer
     */
    public function getCupos()
    {
        return $this->cupos;
    }

    /**
     * Set maxCitasAgregadas
     *
     * @param integer $maxCitasAgregadas
     * @return CitDistribucionProcedimiento
     */
    public function setMaxCitasAgregadas($maxCitasAgregadas)
    {
        $this->maxCitasAgregadas = $maxCitasAgregadas;

        return $this;
    }

    /**
     * Get maxCitasAgregadas
     *
     * @return integer
     */
    public function getMaxCitasAgregadas()
    {
        return $this->maxCitasAgregadas;
    }

    /**
     * Set tiempoLecturaDias
     *
     * @param integer $tiempoLecturaDias
     * @return CitDistribucionProcedimiento
     */
    public function setTiempoLecturaDias($tiempoLecturaDias)
    {
        $this->tiempoLecturaDias = $tiempoLecturaDias;

        return $this;
    }

    /**
     * Get tiempoLecturaDias
     *
     * @return integer
     */
    public function getTiempoLecturaDias()
    {
        return $this->tiempoLecturaDias;
    }

    /**
     * Set dia
     *
     * @param integer $dia
     * @return CitDistribucionProcedimiento
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return integer
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set mes
     *
     * @param integer $mes
     * @return CitDistribucionProcedimiento
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return integer
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set yrs
     *
     * @param integer $yrs
     * @return CitDistribucionProcedimiento
     */
    public function setYrs($yrs)
    {
        $this->yrs = $yrs;

        return $this;
    }

    /**
     * Get yrs
     *
     * @return integer
     */
    public function getYrs()
    {
        return $this->yrs;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CitDistribucionProcedimiento
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
     * @return CitDistribucionProcedimiento
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
     * Set idRangohora
     *
     * @param \Minsal\SiapsBundle\Entity\MntRangohora $idRangohora
     * @return CitDistribucionProcedimiento
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
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return CitDistribucionProcedimiento
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
     * Set idAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab
     * @return CitDistribucionProcedimiento
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return CitDistribucionProcedimiento
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
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return CitDistribucionProcedimiento
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
     * Set idProcedimientoEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento $idProcedimientoEstablecimiento
     * @return CitDistribucionProcedimiento
     */
    public function setIdProcedimientoEstablecimiento(\Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento $idProcedimientoEstablecimiento = null)
    {
        $this->idProcedimientoEstablecimiento = $idProcedimientoEstablecimiento;

        return $this;
    }

    /**
     * Get idProcedimientoEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento
     */
    public function getIdProcedimientoEstablecimiento()
    {
        return $this->idProcedimientoEstablecimiento;
    }

    /**
     * Set idEstado
     *
     * @param \Minsal\CitasBundle\Entity\CitEstadoDistribucion $idEstadoDistribucion
     * @return CitDistribucion
     */
    public function setIdEstadoDistribucion(\Minsal\CitasBundle\Entity\CitEstadoDistribucion $idEstadoDistribucion = null)
    {
        $this->idEstadoDistribucion = $idEstadoDistribucion;

        return $this;
    }

    /**
     * Get idEstadoDistribucion
     *
     * @return \Minsal\CitasBundle\Entity\CitEstadoDistribucion
     */
    public function getIdEstadoDistribucion()
    {
        return $this->idEstadoDistribucion;
    }

    public function __toString() {
        return $this->id ? ( $this->idAreaModEstab.' - '.$this->idProcedimientoEstablecimiento->getIdCiq().' - '.( $this->idEmpleado ? $this->idEmpleado->getNombreempleado() : 'Todos los Médicos' ).' - '.$this->idRangohora.' - '.$this->yrs.' - '.$this->getMonthName().' - '.$this->getDayName() ) : '';
    }

    public function getMonthName () {
        $month = $this->id ? $this->mes : '';
        $monthName = $month === 1 ? 'Enero' : ( $month === 2 ? 'Febrero' : ( $month === 3 ? 'Marzo' : ( $month === 4 ? 'Abril' : ( $month === 5 ? 'Mayo' : ( $month === 6 ? 'Junio' : ( $month === 7 ? 'Julio' : ( $month === 8 ? 'Agosto' : ( $month === 9 ? 'Septiembre' : ( $month === 10 ? 'Octubre' : ( $month === 11 ? 'Noviembre' : ( $month === 12 ? 'Diciembre' : '' ) ) ) ) ) ) ) ) ) ) );

        return $monthName;
    }

    public function getDayName() {
        $day = $this->id ? $this->dia : '';
        $dayName = $day === 1 ? 'Lunes' : ( $day === 2 ? 'Martes' : ( $day === 3 ? 'Miércoles' : ( $day === 4 ? 'Jueves' : ( $day === 5 ? 'Viernes' : ( $day === 6 ? 'Sábado' : ( $day === 7 ? 'Domingo' : '' ) ) ) ) ) );

        return $dayName;
    }

    /**
     * Set idTipoDistribucion
     *
     * @param \Minsal\CitasBundle\Entity\CitTipoDistribucion $idTipoDistribucion
     * @return CitDistribucionProcedimiento
     */
    public function setIdTipoDistribucion(\Minsal\CitasBundle\Entity\CitTipoDistribucion $idTipoDistribucion = null)
    {
        $this->idTipoDistribucion = $idTipoDistribucion;

        return $this;
    }

    /**
     * Get idTipoDistribucion
     *
     * @return \Minsal\CitasBundle\Entity\CitTipoDistribucion 
     */
    public function getIdTipoDistribucion()
    {
        return $this->idTipoDistribucion;
    }
}
