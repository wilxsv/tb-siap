<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSignosVitales
 *
 * @ORM\Table(name="sec_signos_vitales", indexes={@ORM\Index(name="IDX_9222FCE331827296", columns={"id_historial_clinico"})})
 * @ORM\Entity
 */
class SecSignosVitales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_signos_vitales_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="temperatura", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $temperatura;

    /**
     * @var string
     *
     * @ORM\Column(name="peso", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="talla", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $talla;

    /**
     * @var integer
     *
     * @ORM\Column(name="frecuencia_respiratoria", type="integer", nullable=false)
     */
    private $frecuenciaRespiratoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="frecuencia_cardiaca", type="integer", nullable=false)
     */
    private $frecuenciaCardiaca;

    /**
     * @var string
     *
     * @ORM\Column(name="presion_arterial", type="string", length=8, nullable=false)
     */
    private $presionArterial;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
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
     * Set temperatura
     *
     * @param string $temperatura
     * @return SecSignosVitales
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    /**
     * Get temperatura
     *
     * @return string 
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * Set peso
     *
     * @param string $peso
     * @return SecSignosVitales
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return string 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set talla
     *
     * @param string $talla
     * @return SecSignosVitales
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;

        return $this;
    }

    /**
     * Get talla
     *
     * @return string 
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set frecuenciaRespiratoria
     *
     * @param integer $frecuenciaRespiratoria
     * @return SecSignosVitales
     */
    public function setFrecuenciaRespiratoria($frecuenciaRespiratoria)
    {
        $this->frecuenciaRespiratoria = $frecuenciaRespiratoria;

        return $this;
    }

    /**
     * Get frecuenciaRespiratoria
     *
     * @return integer 
     */
    public function getFrecuenciaRespiratoria()
    {
        return $this->frecuenciaRespiratoria;
    }

    /**
     * Set frecuenciaCardiaca
     *
     * @param integer $frecuenciaCardiaca
     * @return SecSignosVitales
     */
    public function setFrecuenciaCardiaca($frecuenciaCardiaca)
    {
        $this->frecuenciaCardiaca = $frecuenciaCardiaca;

        return $this;
    }

    /**
     * Get frecuenciaCardiaca
     *
     * @return integer 
     */
    public function getFrecuenciaCardiaca()
    {
        return $this->frecuenciaCardiaca;
    }

    /**
     * Set presionArterial
     *
     * @param string $presionArterial
     * @return SecSignosVitales
     */
    public function setPresionArterial($presionArterial)
    {
        $this->presionArterial = $presionArterial;

        return $this;
    }

    /**
     * Get presionArterial
     *
     * @return string 
     */
    public function getPresionArterial()
    {
        return $this->presionArterial;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecSignosVitales
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
}
