<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSustanciaDosis
 *
 * @ORM\Table(name="sec_sustancia_dosis", indexes={@ORM\Index(name="fki_sustancia_detalle_sustancia_dosis", columns={"id_sustancia_detalle"})})
 * @ORM\Entity
 */
class SecSustanciaDosis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_sustancia_dosis_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="consumo_diario", type="integer", nullable=false)
     */
    private $consumoDiario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="frecuencia_semanal", type="integer", nullable=false)
     */
    private $frecuenciaSemanal = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \SecSustanciaDetalle
     *
     * @ORM\ManyToOne(targetEntity="SecSustanciaDetalle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sustancia_detalle", referencedColumnName="id")
     * })
     */
    private $idSustanciaDetalle;



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
     * Set consumoDiario
     *
     * @param integer $consumoDiario
     * @return SecSustanciaDosis
     */
    public function setConsumoDiario($consumoDiario)
    {
        $this->consumoDiario = $consumoDiario;

        return $this;
    }

    /**
     * Get consumoDiario
     *
     * @return integer 
     */
    public function getConsumoDiario()
    {
        return $this->consumoDiario;
    }

    /**
     * Set frecuenciaSemanal
     *
     * @param integer $frecuenciaSemanal
     * @return SecSustanciaDosis
     */
    public function setFrecuenciaSemanal($frecuenciaSemanal)
    {
        $this->frecuenciaSemanal = $frecuenciaSemanal;

        return $this;
    }

    /**
     * Get frecuenciaSemanal
     *
     * @return integer 
     */
    public function getFrecuenciaSemanal()
    {
        return $this->frecuenciaSemanal;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return SecSustanciaDosis
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idSustanciaDetalle
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSustanciaDetalle $idSustanciaDetalle
     * @return SecSustanciaDosis
     */
    public function setIdSustanciaDetalle(\Minsal\SeguimientoBundle\Entity\SecSustanciaDetalle $idSustanciaDetalle = null)
    {
        $this->idSustanciaDetalle = $idSustanciaDetalle;

        return $this;
    }

    /**
     * Get idSustanciaDetalle
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecSustanciaDetalle 
     */
    public function getIdSustanciaDetalle()
    {
        return $this->idSustanciaDetalle;
    }
}
