<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabDatosfijosresultado
 *
 * @ORM\Table(name="lab_datosfijosresultado", indexes={@ORM\Index(name="IDX_3FFD4FF775BB31F7", columns={"idestablecimiento"}), @ORM\Index(name="IDX_3FFD4FF76724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_3FFD4FF713B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_3FFD4FF78794B5D6", columns={"idedad"}), @ORM\Index(name="IDX_3FFD4FF7FFF6A732", columns={"idsexo"}), @ORM\Index(name="IDX_3FFD4FF7271DEBD7", columns={"id_conf_examen_estab"})})
 * @ORM\Entity
 */
class LabDatosfijosresultado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_datosfijosresultado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="unidades", type="string", length=20, nullable=true)
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
     * @ORM\Column(name="nota", type="string", length=250, nullable=true)
     */
    private $nota;

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
     * @var Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var Application\Sonata\UserBundle\Entity\User
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
     *   @ORM\JoinColumn(name="idedad", referencedColumnName="id")
     * })
     */
    private $idedad;

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
     * Set unidades
     *
     * @param string $unidades
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * Set nota
     *
     * @param string $nota
     * @return LabDatosfijosresultado
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return string
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set fechaini
     *
     * @param \DateTime $fechaini
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
     * Set idedad
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idedad
     * @return LabDatosfijosresultado
     */
    public function setIdedad(\Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idedad = null)
    {
        $this->idedad = $idedad;

        return $this;
    }

    /**
     * Get idedad
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlRangoEdad
     */
    public function getIdedad()
    {
        return $this->idedad;
    }

    /**
     * Set idsexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idsexo
     * @return LabDatosfijosresultado
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
     * @return LabDatosfijosresultado
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
