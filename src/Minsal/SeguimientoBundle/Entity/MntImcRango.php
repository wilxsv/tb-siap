<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntImcRango
 *
 * @ORM\Table(name="mnt_imc_rango", indexes={@ORM\Index(name="IDX_C8F49585E2C1B42E", columns={"id_clasificacion_peso"}), @ORM\Index(name="IDX_C8F49585301F60F3", columns={"id_imc_parametros"})})
 * @ORM\Entity
 */
class MntImcRango
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_imc_rango_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="rango_minimo", type="float", precision=10, scale=0, nullable=false)
     */
    private $rangoMinimo = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="rango_maximo", type="float", precision=10, scale=0, nullable=false)
     */
    private $rangoMaximo = '0';

    /**
     * @var \CtlClasificacionPeso
     *
     * @ORM\ManyToOne(targetEntity="CtlClasificacionPeso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_clasificacion_peso", referencedColumnName="id")
     * })
     */
    private $idClasificacionPeso;

    /**
     * @var \SecImcParametros
     *
     * @ORM\ManyToOne(targetEntity="SecImcParametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_imc_parametros", referencedColumnName="id")
     * })
     */
    private $idImcParametros;



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
     * Set rangoMinimo
     *
     * @param float $rangoMinimo
     * @return MntImcRango
     */
    public function setRangoMinimo($rangoMinimo)
    {
        $this->rangoMinimo = $rangoMinimo;

        return $this;
    }

    /**
     * Get rangoMinimo
     *
     * @return float 
     */
    public function getRangoMinimo()
    {
        return $this->rangoMinimo;
    }

    /**
     * Set rangoMaximo
     *
     * @param float $rangoMaximo
     * @return MntImcRango
     */
    public function setRangoMaximo($rangoMaximo)
    {
        $this->rangoMaximo = $rangoMaximo;

        return $this;
    }

    /**
     * Get rangoMaximo
     *
     * @return float 
     */
    public function getRangoMaximo()
    {
        return $this->rangoMaximo;
    }

    /**
     * Set idClasificacionPeso
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlClasificacionPeso $idClasificacionPeso
     * @return MntImcRango
     */
    public function setIdClasificacionPeso(\Minsal\SeguimientoBundle\Entity\CtlClasificacionPeso $idClasificacionPeso = null)
    {
        $this->idClasificacionPeso = $idClasificacionPeso;

        return $this;
    }

    /**
     * Get idClasificacionPeso
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlClasificacionPeso 
     */
    public function getIdClasificacionPeso()
    {
        return $this->idClasificacionPeso;
    }

    /**
     * Set idImcParametros
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecImcParametros $idImcParametros
     * @return MntImcRango
     */
    public function setIdImcParametros(\Minsal\SeguimientoBundle\Entity\SecImcParametros $idImcParametros = null)
    {
        $this->idImcParametros = $idImcParametros;

        return $this;
    }

    /**
     * Get idImcParametros
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecImcParametros 
     */
    public function getIdImcParametros()
    {
        return $this->idImcParametros;
    }
}
