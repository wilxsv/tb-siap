<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabTipomuestraporexamen
 *
 * @ORM\Table(name="lab_tipomuestraporexamen", indexes={@ORM\Index(name="fki_tipomuestra_tipomuestraporexamen", columns={"idtipomuestra"}), @ORM\Index(name="IDX_5C44865935F12240", columns={"idexamen"}), @ORM\Index(name="IDX_5C4486596724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_5C44865913B895A1", columns={"idusuarioreg"})})
 * @ORM\Entity
 */
class LabTipomuestraporexamen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_tipomuestraporexamen_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @ORM\Column(name="habilitado", type="boolean", nullable=false)
     */
    private $habilitado = true;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico")
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
     * @var \LabTipomuestra
     *
     * @ORM\ManyToOne(targetEntity="LabTipomuestra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtipomuestra", referencedColumnName="id")
     * })
     */
    private $idtipomuestra;



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
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return LabTipomuestraporexamen
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
     * @return LabTipomuestraporexamen
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
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return LabTipomuestraporexamen
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set idexamen
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico $idexamen
     * @return LabTipomuestraporexamen
     */
    public function setIdexamen(\Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico $idexamen = null)
    {
        $this->idexamen = $idexamen;

        return $this;
    }

    /**
     * Get idexamen
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico 
     */
    public function getIdexamen()
    {
        return $this->idexamen;
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return LabTipomuestraporexamen
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
     * @return LabTipomuestraporexamen
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
     * Set idtipomuestra
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabTipomuestra $idtipomuestra
     * @return LabTipomuestraporexamen
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
}
