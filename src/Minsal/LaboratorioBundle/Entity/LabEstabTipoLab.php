<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabEstabTipoLab
 *
 * @ORM\Table(name="lab_estab_tipo_lab", indexes={@ORM\Index(name="IDX_E6B839A57DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_E6B839A54B9316FF", columns={"id_tipo_laboratorio"})})
 * @ORM\Entity
 */
class LabEstabTipoLab
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_estab_tipo_lab_id_seq", allocationSize=1, initialValue=1)
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
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return LabEstabTipoLab
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
     * Set idTipoLaboratorio
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlTipoLaboratorio $idTipoLaboratorio
     * @return LabEstabTipoLab
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
