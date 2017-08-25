<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntFarmaciaxestablecimiento
 *
 * @ORM\Table(name="mnt_farmaciaxestablecimiento", indexes={@ORM\Index(name="IDX_791D56B947B0200", columns={"idfarmacia"})})
 * @ORM\Entity
 */
class MntFarmaciaxestablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_farmaciaxestablecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var string
     *
     * @ORM\Column(name="habilitadofarmacia", type="string", nullable=false)
     */
    private $habilitadofarmacia = 'N';

   /**
     * @var \Minsal\SiapsBundle\Entity\Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlModalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmodalidad", referencedColumnName="id")
     * })
     */
    private $idmodalidad;

    /**
     * @var \MntFarmacia
     *
     * @ORM\ManyToOne(targetEntity="MntFarmacia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idfarmacia", referencedColumnName="id")
     * })
     */
    private $idfarmacia;



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
     * Set habilitadofarmacia
     *
     * @param string $habilitadofarmacia
     * @return MntFarmaciaxestablecimiento
     */
    public function setHabilitadofarmacia($habilitadofarmacia)
    {
        $this->habilitadofarmacia = $habilitadofarmacia;

        return $this;
    }

    /**
     * Get habilitadofarmacia
     *
     * @return string 
     */
    public function getHabilitadofarmacia()
    {
        return $this->habilitadofarmacia;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return MntFarmaciaxestablecimiento
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
     * @return MntFarmaciaxestablecimiento
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
     * Set idfarmacia
     *
     * @param \Minsal\FarmaciaBundle\Entity\MntFarmacia $idfarmacia
     * @return MntFarmaciaxestablecimiento
     */
    public function setIdfarmacia(\Minsal\FarmaciaBundle\Entity\MntFarmacia $idfarmacia = null)
    {
        $this->idfarmacia = $idfarmacia;

        return $this;
    }

    /**
     * Get idfarmacia
     *
     * @return \Minsal\FarmaciaBundle\Entity\MntFarmacia 
     */
    public function getIdfarmacia()
    {
        return $this->idfarmacia;
    }
}
