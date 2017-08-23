<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabProcedimientosporexamen
 *
 * @ORM\Table(name="lab_procedimientosporexamen", indexes={@ORM\Index(name="IDX_8E89EC9475BB31F7", columns={"idestablecimiento"}), @ORM\Index(name="IDX_8E89EC946724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_8E89EC9413B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_8E89EC94FA038581", columns={"idrangoedad"}), @ORM\Index(name="IDX_8E89EC94FFF6A732", columns={"idsexo"}), @ORM\Index(name="IDX_8E89EC94271DEBD7", columns={"id_conf_examen_estab"})})
 * @ORM\Entity
 */
class LabProcedimientosporexamen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_procedimientosporexamen_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreprocedimiento", type="string", length=150, nullable=true)
     */
    private $nombreprocedimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="unidades", type="string", length=60, nullable=true)
     */
    private $unidades;

    /**
     * @var float
     *
     * @ORM\Column(name="rangoinicio", type="float", precision=10, scale=0, nullable=true)
     */
    private $rangoinicio;

    /**
     * @var float
     *
     * @ORM\Column(name="rangofin", type="float", precision=10, scale=0, nullable=true)
     */
    private $rangofin;

    /**
     * @var string
     *
     * @ORM\Column(name="controldiario", type="string", length=150, nullable=true)
     */
    private $controldiario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaini", type="date", nullable=true)
     */
    private $fechaini;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafin", type="date", nullable=true)
     */
    private $fechafin;

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
     * @var \Minsal\SeguimientoBundle\Entity\CtlRangoEdad
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\CtlRangoEdad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idrangoedad", referencedColumnName="id")
     * })
     */
    private $idrangoedad;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsexo", referencedColumnName="id")
     * })
     */
    private $idsexo;

    /**
     * @var \LabConfExamenEstab
     *
     * @ORM\ManyToOne(targetEntity="LabConfExamenEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conf_examen_estab", referencedColumnName="id")
     * })
     */
    private $idConfExamenEstab;



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
     * Set nombreprocedimiento
     *
     * @param string $nombreprocedimiento
     * @return LabProcedimientosporexamen
     */
    public function setNombreprocedimiento($nombreprocedimiento)
    {
        $this->nombreprocedimiento = $nombreprocedimiento;

        return $this;
    }

    /**
     * Get nombreprocedimiento
     *
     * @return string 
     */
    public function getNombreprocedimiento()
    {
        return $this->nombreprocedimiento;
    }

    /**
     * Set unidades
     *
     * @param string $unidades
     * @return LabProcedimientosporexamen
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get unidades
     *
     * @return string 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set rangoinicio
     *
     * @param float $rangoinicio
     * @return LabProcedimientosporexamen
     */
    public function setRangoinicio($rangoinicio)
    {
        $this->rangoinicio = $rangoinicio;

        return $this;
    }

    /**
     * Get rangoinicio
     *
     * @return float 
     */
    public function getRangoinicio()
    {
        return $this->rangoinicio;
    }

    /**
     * Set rangofin
     *
     * @param float $rangofin
     * @return LabProcedimientosporexamen
     */
    public function setRangofin($rangofin)
    {
        $this->rangofin = $rangofin;

        return $this;
    }

    /**
     * Get rangofin
     *
     * @return float 
     */
    public function getRangofin()
    {
        return $this->rangofin;
    }

    /**
     * Set controldiario
     *
     * @param string $controldiario
     * @return LabProcedimientosporexamen
     */
    public function setControldiario($controldiario)
    {
        $this->controldiario = $controldiario;

        return $this;
    }

    /**
     * Get controldiario
     *
     * @return string 
     */
    public function getControldiario()
    {
        return $this->controldiario;
    }

    /**
     * Set fechaini
     *
     * @param \DateTime $fechaini
     * @return LabProcedimientosporexamen
     */
    public function setFechaini($fechaini)
    {
        $this->fechaini = $fechaini;

        return $this;
    }

    /**
     * Get fechaini
     *
     * @return \DateTime 
     */
    public function getFechaini()
    {
        return $this->fechaini;
    }

    /**
     * Set fechafin
     *
     * @param \DateTime $fechafin
     * @return LabProcedimientosporexamen
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return \DateTime 
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return LabProcedimientosporexamen
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
     * @return LabProcedimientosporexamen
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
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return LabProcedimientosporexamen
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
     * @return LabProcedimientosporexamen
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
     * @return LabProcedimientosporexamen
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
     * Set idrangoedad
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idrangoedad
     * @return LabProcedimientosporexamen
     */
    public function setIdrangoedad(\Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idrangoedad = null)
    {
        $this->idrangoedad = $idrangoedad;

        return $this;
    }

    /**
     * Get idrangoedad
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlRangoEdad 
     */
    public function getIdrangoedad()
    {
        return $this->idrangoedad;
    }

    /**
     * Set idsexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idsexo
     * @return LabProcedimientosporexamen
     */
    public function setIdsexo(\Minsal\SiapsBundle\Entity\CtlSexo $idsexo = null)
    {
        $this->idsexo = $idsexo;

        return $this;
    }

    /**
     * Get idsexo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlSexo 
     */
    public function getIdsexo()
    {
        return $this->idsexo;
    }

    /**
     * Set idConfExamenEstab
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idConfExamenEstab
     * @return LabProcedimientosporexamen
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
}
