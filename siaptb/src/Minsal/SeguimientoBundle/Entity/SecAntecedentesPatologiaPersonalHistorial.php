<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesPatologiaPersonalHistorial
 *
 * @ORM\Table(name="sec_antecedentes_patologia_personal_historial", indexes={@ORM\Index(name="fki_histo_clini_antec_patol_perso_histo", columns={"id_historia_clinica"}), @ORM\Index(name="fki_antec_patol_perso_antec_patol_perso_histo", columns={"id_antecedente_patologia_personal"})})
 * @ORM\Entity
 */
class SecAntecedentesPatologiaPersonalHistorial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_patologia_personal_historial_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecAntecedentesPatologiaPersonal
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesPatologiaPersonal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedente_patologia_personal", referencedColumnName="id")
     * })
     */
    private $idAntecedentePatologiaPersonal;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historia_clinica", referencedColumnName="id")
     * })
     */
    private $idHistoriaClinica;



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
     * Set idAntecedentePatologiaPersonal
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaPersonal $idAntecedentePatologiaPersonal
     * @return SecAntecedentesPatologiaPersonalHistorial
     */
    public function setIdAntecedentePatologiaPersonal(\Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaPersonal $idAntecedentePatologiaPersonal = null)
    {
        $this->idAntecedentePatologiaPersonal = $idAntecedentePatologiaPersonal;

        return $this;
    }

    /**
     * Get idAntecedentePatologiaPersonal
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaPersonal 
     */
    public function getIdAntecedentePatologiaPersonal()
    {
        return $this->idAntecedentePatologiaPersonal;
    }

    /**
     * Set idHistoriaClinica
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistoriaClinica
     * @return SecAntecedentesPatologiaPersonalHistorial
     */
    public function setIdHistoriaClinica(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistoriaClinica = null)
    {
        $this->idHistoriaClinica = $idHistoriaClinica;

        return $this;
    }

    /**
     * Get idHistoriaClinica
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico 
     */
    public function getIdHistoriaClinica()
    {
        return $this->idHistoriaClinica;
    }
}
