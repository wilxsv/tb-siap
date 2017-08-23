<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntOrigenmuestra
 *
 * @ORM\Table(name="mnt_origenmuestra", indexes={@ORM\Index(name="IDX_8B9FA3D16724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_8B9FA3D113B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_8B9FA3D1DAB57264", columns={"idtipomuestra"})})
 * @ORM\Entity
 */
class MntOrigenmuestra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_origenmuestra_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="origenmuestra", type="string", length=60, nullable=true)
     */
    private $origenmuestra;

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
     * Set origenmuestra
     *
     * @param string $origenmuestra
     * @return MntOrigenmuestra
     */
    public function setOrigenmuestra($origenmuestra)
    {
        $this->origenmuestra = $origenmuestra;

        return $this;
    }

    /**
     * Get origenmuestra
     *
     * @return string 
     */
    public function getOrigenmuestra()
    {
        return $this->origenmuestra;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return MntOrigenmuestra
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
     * @return MntOrigenmuestra
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
     * @return MntOrigenmuestra
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
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return MntOrigenmuestra
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
     * @return MntOrigenmuestra
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
     * @return MntOrigenmuestra
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
