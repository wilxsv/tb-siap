<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesLaboral
 *
 * @ORM\Table(name="sec_antecedentes_laboral", indexes={@ORM\Index(name="IDX_C26323A927746649", columns={"id_antecedentes_otro"})})
 * @ORM\Entity
 */
class SecAntecedentesLaboral
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_laboral_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio_labores", type="date", nullable=true)
     */
    private $fechaInicioLabores;

    /**
     * @var \SecAntecedentesOtro
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesOtro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes_otro", referencedColumnName="id")
     * })
     */
    private $idAntecedentesOtro;



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
     * Set fechaInicioLabores
     *
     * @param \DateTime $fechaInicioLabores
     * @return SecAntecedentesLaboral
     */
    public function setFechaInicioLabores($fechaInicioLabores)
    {
        $this->fechaInicioLabores = $fechaInicioLabores;

        return $this;
    }

    /**
     * Get fechaInicioLabores
     *
     * @return \DateTime 
     */
    public function getFechaInicioLabores()
    {
        return $this->fechaInicioLabores;
    }

    /**
     * Set idAntecedentesOtro
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesOtro $idAntecedentesOtro
     * @return SecAntecedentesLaboral
     */
    public function setIdAntecedentesOtro(\Minsal\SeguimientoBundle\Entity\SecAntecedentesOtro $idAntecedentesOtro = null)
    {
        $this->idAntecedentesOtro = $idAntecedentesOtro;

        return $this;
    }

    /**
     * Get idAntecedentesOtro
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesOtro 
     */
    public function getIdAntecedentesOtro()
    {
        return $this->idAntecedentesOtro;
    }
}
