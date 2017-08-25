<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitDistribucion
 *
 * @ORM\Table(name="cit_distribucion", indexes={@ORM\Index(name="fki_mnt_empleados_mod_cit_distribucion", columns={"idusuariomod"}), @ORM\Index(name="fki_mnt_usuarios_cit_distribucion", columns={"idusuarioreg"}), @ORM\Index(name="fki_mnt_rangohoras_cit_distribucion", columns={"id_rangohora"}), @ORM\Index(name="fki_mnt_area_mod_estab_cit_distribucion", columns={"id_area_mod_estab"}), @ORM\Index(name="fki_mnt_empleados_cit_distribucion", columns={"id_empleado"}), @ORM\Index(name="fki_mnt_consultorios_cit_distribucion", columns={"id_consultorio"}), @ORM\Index(name="IDX_714607E8627A85B", columns={"id_aten_area_mod_estab"}), @ORM\Index(name="IDX_714607E2BE26EB0", columns={"id_tipo_distribucion"})})
 * @ORM\Entity(repositoryClass="Minsal\CitasBundle\Repositorio\CitDistribucionRepository")
 */
class CitDistribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_distribucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="primera", type="integer", nullable=true)
     */
    private $primera='0';

    /**
     * @var integer
     *
     * @ORM\Column(name="subsecuente", type="integer", nullable=true)
     */
    private $subsecuente='0';

    /**
     * @var integer
     *
     * @ORM\Column(name="mes", type="integer", nullable=true)
     */
    private $mes;

    /**
     * @var integer
     *
     * @ORM\Column(name="yrs", type="integer", nullable=true)
     */
    private $yrs;

    /**
     * @var integer
     *
     * @ORM\Column(name="dia", type="integer", nullable=true)
     */
    private $dia;

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
     * @var integer
     *
     * @ORM\Column(name="max_citas_agregadas", type="integer", nullable=false)
     */
    private $maxCitasAgregadas = '0';

    /**
     * @var \Minsal\CitasBundle\Entity\CitEstadoDistribucion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitEstadoDistribucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_distribucion", referencedColumnName="id")
     * })
     */
    private $idEstadoDistribucion = '1';

    /**
     * @var \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aten_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAtenAreaModEstab;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntConsultorio
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntConsultorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_consultorio", referencedColumnName="id")
     * })
     */
    private $idConsultorio;

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
     * @var \Minsal\SiapsBundle\Entity\MntAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAreaModEstab;

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
     * @var \Minsal\SiapsBundle\Entity\MntRangohora
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntRangohora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rangohora", referencedColumnName="id")
     * })
     */
    private $idRangohora;

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
     * Set primera
     *
     * @param integer $primera
     * @return CitDistribucion
     */
    public function setPrimera($primera)
    {
        $this->primera = $primera;

        return $this;
    }

    /**
     * Get primera
     *
     * @return integer
     */
    public function getPrimera()
    {
        return $this->primera;
    }

    /**
     * Set subsecuente
     *
     * @param integer $subsecuente
     * @return CitDistribucion
     */
    public function setSubsecuente($subsecuente)
    {
        $this->subsecuente = $subsecuente;

        return $this;
    }

    /**
     * Get subsecuente
     *
     * @return integer
     */
    public function getSubsecuente()
    {
        return $this->subsecuente;
    }

    /**
     * Set mes
     *
     * @param integer $mes
     * @return CitDistribucion
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
     * @return CitDistribucion
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
     * Set dia
     *
     * @param integer $dia
     * @return CitDistribucion
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
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CitDistribucion
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
     * @return CitDistribucion
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
     * Set maxCitasAgregadas
     *
     * @param integer $maxCitasAgregadas
     * @return CitDistribucion
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

    /**
     * Set idAtenAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab
     * @return CitDistribucion
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
     * Set idConsultorio
     *
     * @param \Minsal\SiapsBundle\Entity\MntConsultorio $idConsultorio
     * @return CitDistribucion
     */
    public function setIdConsultorio(\Minsal\SiapsBundle\Entity\MntConsultorio $idConsultorio = null)
    {
        $this->idConsultorio = $idConsultorio;

        return $this;
    }

    /**
     * Get idConsultorio
     *
     * @return \Minsal\SiapsBundle\Entity\MntConsultorio
     */
    public function getIdConsultorio()
    {
        return $this->idConsultorio;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return CitDistribucion
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return  \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return User
     */
    public function setIdusuariomod(\Application\Sonata\UserBundle\Entity\User $idusuariomod = null)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return  \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set idAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab
     * @return CitDistribucion
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
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return CitDistribucion
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
     * Set idRangohora
     *
     * @param \Minsal\SiapsBundle\Entity\MntRangohora $idRangohora
     * @return CitDistribucion
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
     * Set idTipoDistribucion
     *
     * @param \Minsal\CitasBundle\Entity\CitTipoDistribucion $idTipoDistribucion
     * @return CitDistribucion
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

    public function __toString() {
        return $this->idEmpleado?$this->idEmpleado->getNombreempleado():'';
    }

    public function getDiaSemana(){
        $diaSemana='';
        switch ($this->dia){
            case 1:
                $diaSemana='Lunes';
                break;
            case 2:
                $diaSemana='Martes';
                break;
            case 3:
                $diaSemana='Miércoles';
                break;
            case 4:
                $diaSemana='Jueves';
                break;
            case 5:
                $diaSemana='Viernes';
                break;
            default:
                $diaSemana='Fin de Semana';
                break;
        }
        return $diaSemana;
    }

    public function getNombreMes(){
        $mes='';
        switch ($this->mes){
            case 1:
                $mes='Enero';
                break;
            case 2:
                $mes='Febrero';
                break;
            case 3:
                $mes='Marzo';
                break;
            case 4:
                $mes='Abril';
                break;
            case 5:
                $mes='Mayo';
                break;
           case 6:
                $mes='Junio';
                break;
            case 7:
                $mes='Julio';
                break;
            case 8:
                $mes='Agosto';
                break;
            case 9:
                $mes='Septiembre';
                break;
            case 10:
                $mes='Octubre';
                break;
            case 11:
                $mes='Noviembre';
                break;
            case 12:
                $mes='Diciembre';
                break;
        }
        return $mes;
    }

}
