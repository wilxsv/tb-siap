<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesPatologiaPersonal
 *
 * @ORM\Table(name="sec_antecedentes_patologia_personal", indexes={@ORM\Index(name="fki_patologia_antecedentes_patologia_personal", columns={"id_patologia"}), @ORM\Index(name="fki_antecedentes_antecedentes_patologia_personal", columns={"id_antecedentes"})})
 * @ORM\Entity
 */
class SecAntecedentesPatologiaPersonal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_patologia_personal_id_seq", allocationSize=1, initialValue=1)
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
     * @var \CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patologia", referencedColumnName="id")
     * })
     */
    private $idPatologia;



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
     * @return SecAntecedentesPatologiaPersonal
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
     * Set idPatologia
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlPatologia $idPatologia
     * @return SecAntecedentesPatologiaPersonal
     */
    public function setIdPatologia(\Minsal\SeguimientoBundle\Entity\CtlPatologia $idPatologia = null)
    {
        $this->idPatologia = $idPatologia;

        return $this;
    }

    /**
     * Get idPatologia
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlPatologia 
     */
    public function getIdPatologia()
    {
        return $this->idPatologia;
    }
}
