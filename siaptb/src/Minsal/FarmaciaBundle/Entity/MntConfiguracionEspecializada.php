<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntConfiguracionEspecializada
 *
 * @ORM\Table(name="mnt_configuracion_especializada", indexes={@ORM\Index(name="IDX_6897E7F02294B556", columns={"id_especializada"}), @ORM\Index(name="IDX_6897E7F07DFA12F6", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class MntConfiguracionEspecializada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_configuracion_especializada_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="receta_del_dia", type="integer", nullable=true)
     */
    private $recetaDelDia;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_especializada", referencedColumnName="id")
     * })
     */
    private $idEspecializada;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;



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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return MntConfiguracionEspecializada
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return MntConfiguracionEspecializada
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set recetaDelDia
     *
     * @param integer $recetaDelDia
     * @return MntConfiguracionEspecializada
     */
    public function setRecetaDelDia($recetaDelDia)
    {
        $this->recetaDelDia = $recetaDelDia;

        return $this;
    }

    /**
     * Get recetaDelDia
     *
     * @return integer 
     */
    public function getRecetaDelDia()
    {
        return $this->recetaDelDia;
    }

    /**
     * Set idEspecializada
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEspecializada
     * @return MntConfiguracionEspecializada
     */
    public function setIdEspecializada(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEspecializada = null)
    {
        $this->idEspecializada = $idEspecializada;

        return $this;
    }

    /**
     * Get idEspecializada
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEspecializada()
    {
        return $this->idEspecializada;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return MntConfiguracionEspecializada
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }
}
