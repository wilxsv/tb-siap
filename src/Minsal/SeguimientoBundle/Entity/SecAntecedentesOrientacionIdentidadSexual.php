<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesOrientacionIdentidadSexual
 *
 * @ORM\Table(name="sec_antecedentes_orientacion_identidad_sexual", indexes={@ORM\Index(name="IDX_290682CA1CCD41FE", columns={"id_antecedentes"}), @ORM\Index(name="IDX_290682CAD9E84C3C", columns={"id_identidad_sexual"}), @ORM\Index(name="IDX_290682CA31AFB3AD", columns={"id_orientacion_sexual"})})
 * @ORM\Entity
 */
class SecAntecedentesOrientacionIdentidadSexual
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_orientacion_identidad_sexual_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecAntecedentes
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentes",inversedBy="idAntecedentesOrientacionIdentidadSexual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes", referencedColumnName="id")
     * })
     */
    private $idAntecedentes;

    /**
     * @var \CtlIdentidadGenero
     *
     * @ORM\ManyToOne(targetEntity="CtlIdentidadGenero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_identidad_sexual", referencedColumnName="id")
     * })
     */
    private $identidadSexual;

    /**
     * @var \CtlOrientacionSexual
     *
     * @ORM\ManyToOne(targetEntity="CtlOrientacionSexual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_orientacion_sexual", referencedColumnName="id")
     * })
     */
    private $idOrientacionSexual;



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
     * @return SecAntecedentesOrientacionIdentidadSexual
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
     * Set identidadSexual
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlIdentidadGenero $identidadSexual
     * @return SecAntecedentesOrientacionIdentidadSexual
     */
    public function setIdentidadSexual(\Minsal\SeguimientoBundle\Entity\CtlIdentidadGenero $identidadSexual = null)
    {
        $this->identidadSexual = $identidadSexual;

        return $this;
    }

    /**
     * Get identidadSexual
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlIdentidadGenero 
     */
    public function getIdentidadSexual()
    {
        return $this->identidadSexual;
    }

    /**
     * Set idOrientacionSexual
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlOrientacionSexual $idOrientacionSexual
     * @return SecAntecedentesOrientacionIdentidadSexual
     */
    public function setIdOrientacionSexual(\Minsal\SeguimientoBundle\Entity\CtlOrientacionSexual $idOrientacionSexual = null)
    {
        $this->idOrientacionSexual = $idOrientacionSexual;

        return $this;
    }

    /**
     * Get idOrientacionSexual
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlOrientacionSexual 
     */
    public function getIdOrientacionSexual()
    {
        return $this->idOrientacionSexual;
    }
}
