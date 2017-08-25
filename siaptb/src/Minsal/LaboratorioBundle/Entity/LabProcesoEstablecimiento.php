<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabProcesoEstablecimiento
 *
 * @ORM\Table(name="lab_proceso_establecimiento", indexes={@ORM\Index(name="IDX_80D7A2BE7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_80D7A2BEFB1F2D2D", columns={"id_proceso_laboratorio"})})
 * @ORM\Entity
 */
class LabProcesoEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_proceso_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \LabProcesoLaboratorio
     *
     * @ORM\ManyToOne(targetEntity="LabProcesoLaboratorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proceso_laboratorio", referencedColumnName="id")
     * })
     */
    private $idProcesoLaboratorio;



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
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return LabProcesoEstablecimiento
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

    /**
     * Set idProcesoLaboratorio
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabProcesoLaboratorio $idProcesoLaboratorio
     * @return LabProcesoEstablecimiento
     */
    public function setIdProcesoLaboratorio(\Minsal\LaboratorioBundle\Entity\LabProcesoLaboratorio $idProcesoLaboratorio = null)
    {
        $this->idProcesoLaboratorio = $idProcesoLaboratorio;

        return $this;
    }

    /**
     * Get idProcesoLaboratorio
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabProcesoLaboratorio 
     */
    public function getIdProcesoLaboratorio()
    {
        return $this->idProcesoLaboratorio;
    }
}
