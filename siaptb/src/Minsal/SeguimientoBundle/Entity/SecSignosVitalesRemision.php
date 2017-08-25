<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSignosVitalesRemision
 *
 * @ORM\Table(name="sec_signos_vitales_remision", indexes={@ORM\Index(name="IDX_8941812254A90B01", columns={"id_remision"})})
 * @ORM\Entity
 */
class SecSignosVitalesRemision
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_signos_vitales_remision_id_seq", allocationSize=1, initialValue=1)
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
     * @var \SecRemisionPaciente
     *
     * @ORM\ManyToOne(targetEntity="SecRemisionPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_remision", referencedColumnName="id")
     * })
     */
    private $idRemision;



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
     * @return SecSignosVitalesRemision
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
     * @return SecSignosVitalesRemision
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
     * @return SecSignosVitalesRemision
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
     * @return SecSignosVitalesRemision
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
     * @return SecSignosVitalesRemision
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
     * @return SecSignosVitalesRemision
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
     * Set idRemision
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecRemisionPaciente $idRemision
     * @return SecSignosVitalesRemision
     */
    public function setIdRemision(\Minsal\SeguimientoBundle\Entity\SecRemisionPaciente $idRemision = null)
    {
        $this->idRemision = $idRemision;

        return $this;
    }

    /**
     * Get idRemision
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecRemisionPaciente 
     */
    public function getIdRemision()
    {
        return $this->idRemision;
    }
}
