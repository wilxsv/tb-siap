<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecOtrasObservaciones
 *
 * @ORM\Table(name="sec_otras_observaciones", indexes={@ORM\Index(name="IDX_DF9D7FDD31827296", columns={"id_historial_clinico"})})
 * @ORM\Entity
 */
class SecOtrasObservaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_otras_observaciones_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="indicacion_observacion", type="text", nullable=true)
     */
    private $indicacionObservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="examen_gabinete", type="text", nullable=true)
     */
    private $examenGabinete;
    /**
     * @var string
     *
     * @ORM\Column(name="plan_ingreso", type="text", nullable=true)
     */
    private $planIngreso;


    /**
     * @var \SecHistorialClinico
     *
     * @ORM\OneToOne(targetEntity="SecHistorialClinico", inversedBy="idOtrasObservaciones" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;



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
     * Set indicacionObservacion
     *
     * @param string $indicacionObservacion
     * @return SecOtrasObservaciones
     */
    public function setIndicacionObservacion($indicacionObservacion)
    {
        $this->indicacionObservacion = $indicacionObservacion;

        return $this;
    }

    /**
     * Get indicacionObservacion
     *
     * @return string
     */
    public function getIndicacionObservacion()
    {
        return $this->indicacionObservacion;
    }

    /**
     * Set examenGabinete
     *
     * @param string $examenGabinete
     * @return SecOtrasObservaciones
     */
    public function setExamenGabinete($examenGabinete)
    {
        $this->examenGabinete = $examenGabinete;

        return $this;
    }

    /**
     * Get examenGabinete
     *
     * @return string
     */
    public function getExamenGabinete()
    {
        return $this->examenGabinete;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecOtrasObservaciones
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
     * Set planIngreso
     *
     * @param string $planIngreso
     * @return SecOtrasObservaciones
     */
    public function setPlanIngreso($planIngreso)
    {
        $this->planIngreso = $planIngreso;

        return $this;
    }

    /**
     * Get planIngreso
     *
     * @return string 
     */
    public function getPlanIngreso()
    {
        return $this->planIngreso;
    }
}
