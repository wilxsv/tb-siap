<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabExamenMetodologia
 *
 * @ORM\Table(name="lab_examen_metodologia", indexes={@ORM\Index(name="IDX_633AA87A195D811C", columns={"id_conf_exa_estab"}), @ORM\Index(name="IDX_633AA87A151BC3B", columns={"id_metodologia"})})
 * @ORM\Entity
 */
class LabExamenMetodologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_examen_metodologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var \LabConfExamenEstab
     *
     * @ORM\ManyToOne(targetEntity="LabConfExamenEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conf_exa_estab", referencedColumnName="id")
     * })
     */
    private $idConfExaEstab;

    /**
     * @var \LabMetodologia
     *
     * @ORM\ManyToOne(targetEntity="LabMetodologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_metodologia", referencedColumnName="id")
     * })
     */
    private $idMetodologia;



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
     * Set activo
     *
     * @param boolean $activo
     * @return LabExamenMetodologia
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return LabExamenMetodologia
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
     * @return LabExamenMetodologia
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
     * Set idConfExaEstab
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idConfExaEstab
     * @return LabExamenMetodologia
     */
    public function setIdConfExaEstab(\Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idConfExaEstab = null)
    {
        $this->idConfExaEstab = $idConfExaEstab;

        return $this;
    }

    /**
     * Get idConfExaEstab
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab 
     */
    public function getIdConfExaEstab()
    {
        return $this->idConfExaEstab;
    }

    /**
     * Set idMetodologia
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabMetodologia $idMetodologia
     * @return LabExamenMetodologia
     */
    public function setIdMetodologia(\Minsal\LaboratorioBundle\Entity\LabMetodologia $idMetodologia = null)
    {
        $this->idMetodologia = $idMetodologia;

        return $this;
    }

    /**
     * Get idMetodologia
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabMetodologia 
     */
    public function getIdMetodologia()
    {
        return $this->idMetodologia;
    }
}
