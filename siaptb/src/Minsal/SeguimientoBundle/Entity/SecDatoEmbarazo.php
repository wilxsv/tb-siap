<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecDatoEmbarazo
 *
 * @ORM\Table(name="sec_dato_embarazo", indexes={@ORM\Index(name="IDX_32BE534D31827296", columns={"id_historial_clinico"})})
 * @ORM\Entity
 */
class SecDatoEmbarazo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_dato_embarazo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="semana_amenorrea", type="integer", nullable=false)
     */
    private $semanaAmenorrea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ultima_mestruacion", type="date", nullable=false)
     */
    private $fechaUltimaMestruacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_problable_parto", type="date", nullable=true)
     */
    private $fechaProblableParto;

      /**
     * @var \SecHistorialClinico
     *
     * @ORM\OneToOne(targetEntity="SecHistorialClinico",inversedBy="idDatoEmbarazo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */

    private $idHistorialClinico;

    /**
    * @var \Minsal\SiapsBundle\CtlEstablecimiento
    *
    * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="id_establecimiento_control", referencedColumnName="id", nullable=true)
    * })
    */
    private $idEstablecimientoControl;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_consulta", type="string")
     */
    private $formulaObstetricaConsulta;

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
     * Set semanaAmenorrea
     *
     * @param integer $semanaAmenorrea
     * @return SecDatoEmbarazo
     */
    public function setSemanaAmenorrea($semanaAmenorrea)
    {
        $this->semanaAmenorrea = $semanaAmenorrea;

        return $this;
    }

    /**
     * Get semanaAmenorrea
     *
     * @return integer
     */
    public function getSemanaAmenorrea()
    {
        return $this->semanaAmenorrea;
    }

    /**
     * Set fechaUltimaMestruacion
     *
     * @param \DateTime $fechaUltimaMestruacion
     * @return SecDatoEmbarazo
     */
    public function setFechaUltimaMestruacion($fechaUltimaMestruacion)
    {
        $this->fechaUltimaMestruacion = $fechaUltimaMestruacion;

        return $this;
    }

    /**
     * Get fechaUltimaMestruacion
     *
     * @return \DateTime
     */
    public function getFechaUltimaMestruacion()
    {
        return $this->fechaUltimaMestruacion;
    }

    /**
     * Set fechaProblableParto
     *
     * @param \DateTime $fechaProblableParto
     * @return SecDatoEmbarazo
     */
    public function setFechaProblableParto($fechaProblableParto)
    {
        $this->fechaProblableParto = $fechaProblableParto;

        return $this;
    }

    /**
     * Get fechaProblableParto
     *
     * @return \DateTime
     */
    public function getFechaProblableParto()
    {
        return $this->fechaProblableParto;
    }


    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecDatoEmbarazo
     */
    public function setIdHistorialClinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico = null)
    {
        $this->idHistorialClinico = $idHistorialClinico;

        return $this;
    }

    /**
     * Get idHistorialClinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     */
    public function getIdHistorialClinico()
    {
        return $this->idHistorialClinico;
    }

    /**
     * Set idEstablecimientoControl
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoControl
     * @return SecDatoEmbarazo
     */
    public function setIdEstablecimientoControl(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoControl = null)
    {
        $this->idEstablecimientoControl = $idEstablecimientoControl;

        return $this;
    }

    /**
     * Get idEstablecimientoControl
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoControl()
    {
        return $this->idEstablecimientoControl;
    }

    /**
     * Set formulaObstetricaConsulta
     *
     * @param string $formulaObstetricaConsulta
     * @return SecDatoEmbarazo
     */
    public function setFormulaObstetricaConsulta($formulaObstetricaConsulta)
    {
        $this->formulaObstetricaConsulta = $formulaObstetricaConsulta;

        return $this;
    }

    /**
     * Get formulaObstetricaConsulta
     *
     * @return string
     */
    public function getFormulaObstetricaConsulta()
    {
        return $this->formulaObstetricaConsulta;
    }

    public function __toString() {
        return $this->id ?:'';
    }
}
