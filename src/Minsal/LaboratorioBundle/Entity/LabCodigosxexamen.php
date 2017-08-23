<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabCodigosxexamen
 *
 * @ORM\Table(name="lab_codigosxexamen", indexes={@ORM\Index(name="IDX_785F404E753570E9", columns={"idresultado"}), @ORM\Index(name="IDX_785F404EE8574B1D", columns={"idestandar"})})
 * @ORM\Entity
 */
class LabCodigosxexamen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_codigosxexamen_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \LabCodigosresultados
     *
     * @ORM\ManyToOne(targetEntity="LabCodigosresultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idresultado", referencedColumnName="id")
     * })
     */
    private $idresultado;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestandar", referencedColumnName="id")
     * })
     */
    private $idestandar;



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
     * Set idresultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabCodigosresultados $idresultado
     * @return LabCodigosxexamen
     */
    public function setIdresultado(\Minsal\LaboratorioBundle\Entity\LabCodigosresultados $idresultado = null)
    {
        $this->idresultado = $idresultado;

        return $this;
    }

    /**
     * Get idresultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabCodigosresultados 
     */
    public function getIdresultado()
    {
        return $this->idresultado;
    }

    /**
     * Set idestandar
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico $idestandar
     * @return LabCodigosxexamen
     */
    public function setIdestandar(\Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico $idestandar = null)
    {
        $this->idestandar = $idestandar;

        return $this;
    }

    /**
     * Get idestandar
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlExamenServicioDiagnostico 
     */
    public function getIdestandar()
    {
        return $this->idestandar;
    }
}
