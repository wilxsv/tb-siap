<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntAreafarmaciaxestablecimiento
 *
 * @ORM\Table(name="mnt_areafarmaciaxestablecimiento", indexes={@ORM\Index(name="IDX_2B5F8AA845BCCC8", columns={"idarea"})})
 * @ORM\Entity
 */
class MntAreafarmaciaxestablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrelacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_areafarmaciaxestablecimiento_idrelacion_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitado", type="string", nullable=false)
     */
    private $habilitado = 'S';

 /**
     * @var \Minsal\SiapsBundle\Entity\Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idestablecimiento;

  /**
     * @var \Minsal\SiapsBundle\Entity\Minsal\SiapsBundle\Entity\CtlModalidad
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlModalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmodalidad", referencedColumnName="id")
     * })
     */
    private $idmodalidad;

    /**
     * @var \MntAreafarmacia
     *
     * @ORM\ManyToOne(targetEntity="MntAreafarmacia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idarea", referencedColumnName="id")
     * })
     */
    private $idarea;



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
     * Set habilitado
     *
     * @param string $habilitado
     * @return MntAreafarmaciaxestablecimiento
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return string 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return MntAreafarmaciaxestablecimiento
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
     * Set idmodalidad
     *
     * @param \Minsal\SiapsBundle\Entity\CtlModalidad $idmodalidad
     * @return MntAreafarmaciaxestablecimiento
     */
    public function setIdmodalidad(\Minsal\SiapsBundle\Entity\CtlModalidad $idmodalidad = null)
    {
        $this->idmodalidad = $idmodalidad;

        return $this;
    }

    /**
     * Get idmodalidad
     *
     * @return \Minsal\SiapsBundle\Entity\CtlModalidad 
     */
    public function getIdmodalidad()
    {
        return $this->idmodalidad;
    }

    /**
     * Set idarea
     *
     * @param \Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idarea
     * @return MntAreafarmaciaxestablecimiento
     */
    public function setIdarea(\Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idarea = null)
    {
        $this->idarea = $idarea;

        return $this;
    }

    /**
     * Get idarea
     *
     * @return \Minsal\FarmaciaBundle\Entity\MntAreafarmacia 
     */
    public function getIdarea()
    {
        return $this->idarea;
    }
}
