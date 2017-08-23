<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlExamenServicioDiagnostico
 *
 * @ORM\Table(name="ctl_examen_servicio_diagnostico", indexes={@ORM\Index(name="IDX_1B539A80695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_1B539A806724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_1B539A8013B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_1B539A805A0BF7CA", columns={"idgrupo"})})
 * @ORM\Entity
 */
class CtlExamenServicioDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_examen_servicio_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idestandar", type="string", length=4, nullable=false)
     */
    private $idestandar;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=true)
     */
    private $descripcion;

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
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo = true;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

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
     * @var \LabEstandarxgrupo
     *
     * @ORM\ManyToOne(targetEntity="LabEstandarxgrupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idgrupo", referencedColumnName="id")
     * })
     */
    private $idgrupo;



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
     * Set idestandar
     *
     * @param string $idestandar
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdestandar($idestandar)
    {
        $this->idestandar = $idestandar;

        return $this;
    }

    /**
     * Get idestandar
     *
     * @return string 
     */
    public function getIdestandar()
    {
        return $this->idestandar;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlExamenServicioDiagnostico
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CtlExamenServicioDiagnostico
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
     * @return CtlExamenServicioDiagnostico
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
     * Set activo
     *
     * @param boolean $activo
     * @return CtlExamenServicioDiagnostico
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     * @return CtlExamenServicioDiagnostico
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
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return CtlExamenServicioDiagnostico
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
     * @return CtlExamenServicioDiagnostico
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
     * Set idgrupo
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabEstandarxgrupo $idgrupo
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdgrupo(\Minsal\LaboratorioBundle\Entity\LabEstandarxgrupo $idgrupo = null)
    {
        $this->idgrupo = $idgrupo;

        return $this;
    }

    /**
     * Get idgrupo
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabEstandarxgrupo 
     */
    public function getIdgrupo()
    {
        return $this->idgrupo;
    }
}
