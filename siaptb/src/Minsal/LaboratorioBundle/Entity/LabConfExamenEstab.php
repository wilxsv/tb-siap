<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabConfExamenEstab
 *
 * @ORM\Table(name="lab_conf_examen_estab", indexes={@ORM\Index(name="IDX_3DE90D9412C7E9A0", columns={"idestandarrep"}), @ORM\Index(name="IDX_3DE90D948865BA6", columns={"idplantilla"}), @ORM\Index(name="IDX_3DE90D9413B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_3DE90D946724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_3DE90D9435F12240", columns={"idexamen"}), @ORM\Index(name="IDX_3DE90D94FFF6A732", columns={"idsexo"}), @ORM\Index(name="IDX_3DE90D94CFE47287", columns={"idformulario"})})
 * @ORM\Entity(repositoryClass="Minsal\LaboratorioBundle\Repositorio\LabConfExamenEstabRepository")
 */
class LabConfExamenEstab
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_conf_examen_estab_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", nullable=false)
     */
    private $condicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="urgente", type="integer", nullable=true)
     */
    private $urgente;

    /**
     * @var string
     *
     * @ORM\Column(name="impresion", type="string", nullable=true)
     */
    private $impresion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ubicacion", type="smallint", nullable=true)
     */
    private $ubicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigosumi", type="string", length=8, nullable=true)
     */
    private $codigosumi;

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
     * @var string
     *
     * @ORM\Column(name="nombre_examen", type="string", length=250, nullable=true)
     */
    private $nombreExamen;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_examen", type="string", length=10, nullable=true)
     */
    private $codigoExamen;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestandarrep", referencedColumnName="id")
     * })
     */
    private $idestandarrep;

    /**
     * @var \LabPlantilla
     *
     * @ORM\ManyToOne(targetEntity="LabPlantilla")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplantilla", referencedColumnName="id")
     * })
     */
    private $idplantilla;

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
     * @var Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var \MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="MntAreaExamenEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idexamen", referencedColumnName="id")
     * })
     */
    private $idexamen;

    /**
     * @var \Minsal\SiapsBundle\CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsexo", referencedColumnName="id")
     * })
     */
    private $idsexo;

    /**
     * @var \MntFormulariosxestablecimiento
     *
     * @ORM\ManyToOne(targetEntity="MntFormulariosxestablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idformulario", referencedColumnName="id")
     * })
     */
    private $idformulario;



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
     * Set condicion
     *
     * @param string $condicion
     * @return LabConfExamenEstab
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get condicion
     *
     * @return string
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set urgente
     *
     * @param integer $urgente
     * @return LabConfExamenEstab
     */
    public function setUrgente($urgente)
    {
        $this->urgente = $urgente;

        return $this;
    }

    /**
     * Get urgente
     *
     * @return integer
     */
    public function getUrgente()
    {
        return $this->urgente;
    }

    /**
     * Set impresion
     *
     * @param string $impresion
     * @return LabConfExamenEstab
     */
    public function setImpresion($impresion)
    {
        $this->impresion = $impresion;

        return $this;
    }

    /**
     * Get impresion
     *
     * @return string
     */
    public function getImpresion()
    {
        return $this->impresion;
    }

    /**
     * Set ubicacion
     *
     * @param integer $ubicacion
     * @return LabConfExamenEstab
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return integer
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set codigosumi
     *
     * @param string $codigosumi
     * @return LabConfExamenEstab
     */
    public function setCodigosumi($codigosumi)
    {
        $this->codigosumi = $codigosumi;

        return $this;
    }

    /**
     * Get codigosumi
     *
     * @return string
     */
    public function getCodigosumi()
    {
        return $this->codigosumi;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return LabConfExamenEstab
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
     * @return LabConfExamenEstab
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
     * Set nombreExamen
     *
     * @param string $nombreExamen
     * @return LabConfExamenEstab
     */
    public function setNombreExamen($nombreExamen)
    {
        $this->nombreExamen = $nombreExamen;

        return $this;
    }

    /**
     * Get nombreExamen
     *
     * @return string
     */
    public function getNombreExamen()
    {
        return $this->nombreExamen;
    }

    /**
     * Set codigoExamen
     *
     * @param string $codigoExamen
     * @return LabConfExamenEstab
     */
    public function setCodigoExamen($codigoExamen)
    {
        $this->codigoExamen = $codigoExamen;

        return $this;
    }

    /**
     * Get codigoExamen
     *
     * @return string
     */
    public function getCodigoExamen()
    {
        return $this->codigoExamen;
    }

    /**
     * Set idestandarrep
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico $idestandarrep
     * @return LabConfExamenEstab
     */
    public function setIdestandarrep(\Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico $idestandarrep = null)
    {
        $this->idestandarrep = $idestandarrep;

        return $this;
    }

    /**
     * Get idestandarrep
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico
     */
    public function getIdestandarrep()
    {
        return $this->idestandarrep;
    }

    /**
     * Set idplantilla
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPlantilla $idplantilla
     * @return LabConfExamenEstab
     */
    public function setIdplantilla(\Minsal\LaboratorioBundle\Entity\LabPlantilla $idplantilla = null)
    {
        $this->idplantilla = $idplantilla;

        return $this;
    }

    /**
     * Get idplantilla
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPlantilla
     */
    public function getIdplantilla()
    {
        return $this->idplantilla;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return LabConfExamenEstab
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
     * @return LabConfExamenEstab
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
     * Set idexamen
     *
     * @param \Minsal\LaboratorioBundle\Entity\MntAreaExamenEstablecimiento $idexamen
     * @return LabConfExamenEstab
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
     * Set idsexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idsexo
     * @return LabConfExamenEstab
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
     * Set idformulario
     *
     * @param \Minsal\LaboratorioBundle\Entity\MntFormulariosxestablecimiento $idformulario
     * @return LabConfExamenEstab
     */
    public function setIdformulario(\Minsal\LaboratorioBundle\Entity\MntFormulariosxestablecimiento $idformulario = null)
    {
        $this->idformulario = $idformulario;

        return $this;
    }

    /**
     * Get idformulario
     *
     * @return \Minsal\LaboratorioBundle\Entity\MntFormulariosxestablecimiento
     */
    public function getIdformulario()
    {
        return $this->idformulario;
    }
}
