<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSustanciaDetalle
 *
 * @ORM\Table(name="sec_sustancia_detalle", indexes={@ORM\Index(name="fki_antecedentes_sustancia_sustancia_detalle", columns={"id_antecedentes_sustancia"})})
 * @ORM\Entity
 */
class SecSustanciaDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_sustancia_detalle_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio_inicio_consumo", type="integer", nullable=true)
     */
    private $anioInicioConsumo;

    /**
     * @var integer
     *
     * @ORM\Column(name="anios_consumio", type="integer", nullable=true)
     */
    private $aniosConsumio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="especificacion", type="text", nullable=true)
     */
    private $especificacion;

    /**
     * @var \SecAntecedentesSustancia
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesSustancia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes_sustancia", referencedColumnName="id")
     * })
     */
    private $idAntecedentesSustancia;



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
     * Set anioInicioConsumo
     *
     * @param integer $anioInicioConsumo
     * @return SecSustanciaDetalle
     */
    public function setAnioInicioConsumo($anioInicioConsumo)
    {
        $this->anioInicioConsumo = $anioInicioConsumo;

        return $this;
    }

    /**
     * Get anioInicioConsumo
     *
     * @return integer 
     */
    public function getAnioInicioConsumo()
    {
        return $this->anioInicioConsumo;
    }

    /**
     * Set aniosConsumio
     *
     * @param integer $aniosConsumio
     * @return SecSustanciaDetalle
     */
    public function setAniosConsumio($aniosConsumio)
    {
        $this->aniosConsumio = $aniosConsumio;

        return $this;
    }

    /**
     * Get aniosConsumio
     *
     * @return integer 
     */
    public function getAniosConsumio()
    {
        return $this->aniosConsumio;
    }

    /**
     * Set especificacion
     *
     * @param string $especificacion
     * @return SecSustanciaDetalle
     */
    public function setEspecificacion($especificacion)
    {
        $this->especificacion = $especificacion;

        return $this;
    }

    /**
     * Get especificacion
     *
     * @return string 
     */
    public function getEspecificacion()
    {
        return $this->especificacion;
    }

    /**
     * Set idAntecedentesSustancia
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesSustancia $idAntecedentesSustancia
     * @return SecSustanciaDetalle
     */
    public function setIdAntecedentesSustancia(\Minsal\SeguimientoBundle\Entity\SecAntecedentesSustancia $idAntecedentesSustancia = null)
    {
        $this->idAntecedentesSustancia = $idAntecedentesSustancia;

        return $this;
    }

    /**
     * Get idAntecedentesSustancia
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesSustancia 
     */
    public function getIdAntecedentesSustancia()
    {
        return $this->idAntecedentesSustancia;
    }
}
