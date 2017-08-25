<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesSustancia
 *
 * @ORM\Table(name="sec_antecedentes_sustancia", indexes={@ORM\Index(name="fki_antecedentes_antecedentes_sustancia", columns={"id_antecedentes"}), @ORM\Index(name="fki_sustancia_antecedentes_sustancia", columns={"id_sustancia"})})
 * @ORM\Entity
 */
class SecAntecedentesSustancia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_sustancia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecAntecedentes
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes", referencedColumnName="id")
     * })
     */
    private $idAntecedentes;

    /**
     * @var \CtlSustancia
     *
     * @ORM\ManyToOne(targetEntity="CtlSustancia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sustancia", referencedColumnName="id")
     * })
     */
    private $idSustancia;

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
     * Set idAntecedentes
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentes $idAntecedentes
     * @return SecAntecedentesSustancia
     */
    public function setIdAntecedentes(\Minsal\SeguimientoBundle\Entity\SecAntecedentes $idAntecedentes = null)
    {
        $this->idAntecedentes = $idAntecedentes;

        return $this;
    }

    /**
     * Get idAntecedentes
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentes 
     */
    public function getIdAntecedentes()
    {
        return $this->idAntecedentes;
    }

    /**
     * Set idSustancia
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlSustancia $idSustancia
     * @return SecAntecedentesSustancia
     */
    public function setIdSustancia(\Minsal\SeguimientoBundle\Entity\CtlSustancia $idSustancia = null)
    {
        $this->idSustancia = $idSustancia;

        return $this;
    }

    /**
     * Get idSustancia
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlSustancia 
     */
    public function getIdSustancia()
    {
        return $this->idSustancia;
    }
}
