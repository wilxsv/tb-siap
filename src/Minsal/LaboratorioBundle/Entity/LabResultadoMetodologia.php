<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabResultadoMetodologia
 *
 * @ORM\Table(name="lab_resultado_metodologia", indexes={@ORM\Index(name="IDX_91F409CD8CF54CB6", columns={"id_examen_metodologia"}), @ORM\Index(name="IDX_91F409CD7812238F", columns={"id_codigoresultado"}), @ORM\Index(name="IDX_91F409CD13B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_91F409CD1DD8A541", columns={"id_detallesolicitudestudio"})})
 * @ORM\Entity
 */
class LabResultadoMetodologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_resultado_metodologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=250, nullable=true)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_realizacion", type="datetime", nullable=false)
     */
    private $fechaRealizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_resultado", type="datetime", nullable=true)
     */
    private $fechaResultado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuariomod", type="integer", nullable=true)
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var \LabExamenMetodologia
     *
     * @ORM\ManyToOne(targetEntity="LabExamenMetodologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen_metodologia", referencedColumnName="id")
     * })
     */
    private $idExamenMetodologia;

    /**
     * @var \LabCodigosresultados
     *
     * @ORM\ManyToOne(targetEntity="LabCodigosresultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_codigoresultado", referencedColumnName="id")
     * })
     */
    private $idCodigoresultado;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_detallesolicitudestudio", referencedColumnName="id")
     * })
     */
    private $idDetallesolicitudestudio;



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
     * @return LabResultadoMetodologia
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
     * Set observacion
     *
     * @param string $observacion
     * @return LabResultadoMetodologia
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set fechaRealizacion
     *
     * @param \DateTime $fechaRealizacion
     * @return LabResultadoMetodologia
     */
    public function setFechaRealizacion($fechaRealizacion)
    {
        $this->fechaRealizacion = $fechaRealizacion;

        return $this;
    }

    /**
     * Get fechaRealizacion
     *
     * @return \DateTime 
     */
    public function getFechaRealizacion()
    {
        return $this->fechaRealizacion;
    }

    /**
     * Set fechaResultado
     *
     * @param \DateTime $fechaResultado
     * @return LabResultadoMetodologia
     */
    public function setFechaResultado($fechaResultado)
    {
        $this->fechaResultado = $fechaResultado;

        return $this;
    }

    /**
     * Get fechaResultado
     *
     * @return \DateTime 
     */
    public function getFechaResultado()
    {
        return $this->fechaResultado;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return LabResultadoMetodologia
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime 
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set idusuariomod
     *
     * @param integer $idusuariomod
     * @return LabResultadoMetodologia
     */
    public function setIdusuariomod($idusuariomod)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return integer 
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return LabResultadoMetodologia
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime 
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set idExamenMetodologia
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabExamenMetodologia $idExamenMetodologia
     * @return LabResultadoMetodologia
     */
    public function setIdExamenMetodologia(\Minsal\LaboratorioBundle\Entity\LabExamenMetodologia $idExamenMetodologia = null)
    {
        $this->idExamenMetodologia = $idExamenMetodologia;

        return $this;
    }

    /**
     * Get idExamenMetodologia
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabExamenMetodologia 
     */
    public function getIdExamenMetodologia()
    {
        return $this->idExamenMetodologia;
    }

    /**
     * Set idCodigoresultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabCodigosresultados $idCodigoresultado
     * @return LabResultadoMetodologia
     */
    public function setIdCodigoresultado(\Minsal\LaboratorioBundle\Entity\LabCodigosresultados $idCodigoresultado = null)
    {
        $this->idCodigoresultado = $idCodigoresultado;

        return $this;
    }

    /**
     * Get idCodigoresultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabCodigosresultados 
     */
    public function getIdCodigoresultado()
    {
        return $this->idCodigoresultado;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return LabResultadoMetodologia
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idDetallesolicitudestudio
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios $idDetallesolicitudestudio
     * @return LabResultadoMetodologia
     */
    public function setIdDetallesolicitudestudio(\Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios $idDetallesolicitudestudio = null)
    {
        $this->idDetallesolicitudestudio = $idDetallesolicitudestudio;

        return $this;
    }

    /**
     * Get idDetallesolicitudestudio
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios 
     */
    public function getIdDetallesolicitudestudio()
    {
        return $this->idDetallesolicitudestudio;
    }
}
