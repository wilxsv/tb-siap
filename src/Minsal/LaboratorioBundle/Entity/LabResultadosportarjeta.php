<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabResultadosportarjeta
 *
 * @ORM\Table(name="lab_resultadosportarjeta", indexes={@ORM\Index(name="IDX_7834A74689EFF53A", columns={"idantibiotico"}), @ORM\Index(name="IDX_7834A746692E4D2C", columns={"iddetalleresultado"}), @ORM\Index(name="IDX_7834A74675BB31F7", columns={"idestablecimiento"})})
 * @ORM\Entity
 */
class LabResultadosportarjeta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_resultadosportarjeta_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=10, nullable=true)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=20, nullable=true)
     */
    private $valor;

    /**
     * @var \LabAntibioticos
     *
     * @ORM\ManyToOne(targetEntity="LabAntibioticos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idantibiotico", referencedColumnName="id")
     * })
     */
    private $idantibiotico;

    /**
     * @var \LabDetalleresultado
     *
     * @ORM\ManyToOne(targetEntity="LabDetalleresultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iddetalleresultado", referencedColumnName="id")
     * })
     */
    private $iddetalleresultado;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idestablecimiento;

    /**
     * @var \Minsal\LaboratorioBundle\Entity\LabPosibleResultado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\LaboratorioBundle\Entity\LabPosibleResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_posible_resultado", referencedColumnName="id")
     * })
     */
    private $idPosibleResultado;


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
     * Set resultado
     *
     * @param string $resultado
     * @return LabResultadosportarjeta
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set valor
     *
     * @param string $valor
     * @return LabResultadosportarjeta
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set idantibiotico
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabAntibioticos $idantibiotico
     * @return LabResultadosportarjeta
     */
    public function setIdantibiotico(\Minsal\LaboratorioBundle\Entity\LabAntibioticos $idantibiotico = null)
    {
        $this->idantibiotico = $idantibiotico;

        return $this;
    }

    /**
     * Get idantibiotico
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabAntibioticos
     */
    public function getIdantibiotico()
    {
        return $this->idantibiotico;
    }

    /**
     * Set iddetalleresultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabDetalleresultado $iddetalleresultado
     * @return LabResultadosportarjeta
     */
    public function setIddetalleresultado(\Minsal\LaboratorioBundle\Entity\LabDetalleresultado $iddetalleresultado = null)
    {
        $this->iddetalleresultado = $iddetalleresultado;

        return $this;
    }

    /**
     * Get iddetalleresultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabDetalleresultado
     */
    public function getIddetalleresultado()
    {
        return $this->iddetalleresultado;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return LabResultadosportarjeta
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
     * Get idPosibleResultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPosibleResultado
     */
    public function getIdPosibleResultado()
    {
        return $this->idPosibleResultado;
    }

    /**
     * Set idPosibleResultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosibleResultado
     * @return LabResultadosportarjeta
     */
    public function setIdPosibleResultado(\Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosibleResultado = null)
    {
        $this->idPosibleResultado = $idPosibleResultado;

        return $this;
    }

}
