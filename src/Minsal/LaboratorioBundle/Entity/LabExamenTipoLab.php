<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabExamenTipoLab
 *
 * @ORM\Table(name="lab_examen_tipo_lab", indexes={@ORM\Index(name="IDX_1D62E109271DEBD7", columns={"id_conf_examen_estab"}), @ORM\Index(name="IDX_1D62E1094B9316FF", columns={"id_tipo_laboratorio"})})
 * @ORM\Entity
 */
class LabExamenTipoLab
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_examen_tipo_lab_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \CtlTipoLaboratorio
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoLaboratorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_laboratorio", referencedColumnName="id")
     * })
     */
    private $idTipoLaboratorio;



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
     * Set idConfExamenEstab
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabConfExamenEstab $idConfExamenEstab
     * @return LabExamenTipoLab
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

    /**
     * Set idTipoLaboratorio
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlTipoLaboratorio $idTipoLaboratorio
     * @return LabExamenTipoLab
     */
    public function setIdTipoLaboratorio(\Minsal\LaboratorioBundle\Entity\CtlTipoLaboratorio $idTipoLaboratorio = null)
    {
        $this->idTipoLaboratorio = $idTipoLaboratorio;

        return $this;
    }

    /**
     * Get idTipoLaboratorio
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlTipoLaboratorio 
     */
    public function getIdTipoLaboratorio()
    {
        return $this->idTipoLaboratorio;
    }
}
