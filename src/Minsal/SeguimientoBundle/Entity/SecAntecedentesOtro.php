<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesOtro
 *
 * @ORM\Table(name="sec_antecedentes_otro", indexes={@ORM\Index(name="fki_otro_antecedente_antecedentes_otro", columns={"id_otros_antecedentes"}), @ORM\Index(name="fki_antecedente_antecedentes_otro", columns={"id_antecedentes"}), @ORM\Index(name="IDX_A37E76C945B4A6F0", columns={"id_respuesta_basica"})})
 * @ORM\Entity
 */
class SecAntecedentesOtro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_otro_id_seq", allocationSize=1, initialValue=1)
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
     * @var \CtlOtroAntecedente
     *
     * @ORM\ManyToOne(targetEntity="CtlOtroAntecedente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_otros_antecedentes", referencedColumnName="id")
     * })
     */
    private $idOtrosAntecedentes;

    /**
     * @var \CtlRespuestaBasica
     *
     * @ORM\ManyToOne(targetEntity="CtlRespuestaBasica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_respuesta_basica", referencedColumnName="id")
     * })
     */
    private $idRespuestaBasica;



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
     * @return SecAntecedentesOtro
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
     * Set idOtrosAntecedentes
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlOtroAntecedente $idOtrosAntecedentes
     * @return SecAntecedentesOtro
     */
    public function setIdOtrosAntecedentes(\Minsal\SeguimientoBundle\Entity\CtlOtroAntecedente $idOtrosAntecedentes = null)
    {
        $this->idOtrosAntecedentes = $idOtrosAntecedentes;

        return $this;
    }

    /**
     * Get idOtrosAntecedentes
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlOtroAntecedente 
     */
    public function getIdOtrosAntecedentes()
    {
        return $this->idOtrosAntecedentes;
    }

    /**
     * Set idRespuestaBasica
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlRespuestaBasica $idRespuestaBasica
     * @return SecAntecedentesOtro
     */
    public function setIdRespuestaBasica(\Minsal\SeguimientoBundle\Entity\CtlRespuestaBasica $idRespuestaBasica = null)
    {
        $this->idRespuestaBasica = $idRespuestaBasica;

        return $this;
    }

    /**
     * Get idRespuestaBasica
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlRespuestaBasica 
     */
    public function getIdRespuestaBasica()
    {
        return $this->idRespuestaBasica;
    }
}
