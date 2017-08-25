<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesObstetricos
 *
 * @ORM\Table(name="sec_antecedentes_obstetricos", indexes={@ORM\Index(name="fki_antecedentes_antecedentes_obstetricos", columns={"id_antecedentes"})})
 * @ORM\Entity
 */
class SecAntecedentesObstetricos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_obstetricos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="gestaciones", type="integer", nullable=false)
     */
    private $gestaciones = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="partos_termino", type="integer", nullable=false)
     */
    private $partosTermino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parto_prematuro", type="integer", nullable=false)
     */
    private $partoPrematuro = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="abortos", type="integer", nullable=false)
     */
    private $abortos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nacidos_vivos", type="integer", nullable=false)
     */
    private $nacidosVivos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_menarquia", type="integer", nullable=true)
     */
    private $edadMenarquia;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_inicio_rel_sexual", type="integer", nullable=true)
     */
    private $edadInicioRelSexual;

    /**
     * @var \SecAntecedentes
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentes",inversedBy="idAntecedentesObstetricos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes", referencedColumnName="id")
     * })
     */
    private $idAntecedentes;



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
     * Set gestaciones
     *
     * @param integer $gestaciones
     * @return SecAntecedentesObstetricos
     */
    public function setGestaciones($gestaciones)
    {
        $this->gestaciones = $gestaciones;

        return $this;
    }

    /**
     * Get gestaciones
     *
     * @return integer 
     */
    public function getGestaciones()
    {
        return $this->gestaciones;
    }

    /**
     * Set partosTermino
     *
     * @param integer $partosTermino
     * @return SecAntecedentesObstetricos
     */
    public function setPartosTermino($partosTermino)
    {
        $this->partosTermino = $partosTermino;

        return $this;
    }

    /**
     * Get partosTermino
     *
     * @return integer 
     */
    public function getPartosTermino()
    {
        return $this->partosTermino;
    }

    /**
     * Set partoPrematuro
     *
     * @param integer $partoPrematuro
     * @return SecAntecedentesObstetricos
     */
    public function setPartoPrematuro($partoPrematuro)
    {
        $this->partoPrematuro = $partoPrematuro;

        return $this;
    }

    /**
     * Get partoPrematuro
     *
     * @return integer 
     */
    public function getPartoPrematuro()
    {
        return $this->partoPrematuro;
    }

    /**
     * Set abortos
     *
     * @param integer $abortos
     * @return SecAntecedentesObstetricos
     */
    public function setAbortos($abortos)
    {
        $this->abortos = $abortos;

        return $this;
    }

    /**
     * Get abortos
     *
     * @return integer 
     */
    public function getAbortos()
    {
        return $this->abortos;
    }

    /**
     * Set nacidosVivos
     *
     * @param integer $nacidosVivos
     * @return SecAntecedentesObstetricos
     */
    public function setNacidosVivos($nacidosVivos)
    {
        $this->nacidosVivos = $nacidosVivos;

        return $this;
    }

    /**
     * Get nacidosVivos
     *
     * @return integer 
     */
    public function getNacidosVivos()
    {
        return $this->nacidosVivos;
    }

    /**
     * Set edadMenarquia
     *
     * @param integer $edadMenarquia
     * @return SecAntecedentesObstetricos
     */
    public function setEdadMenarquia($edadMenarquia)
    {
        $this->edadMenarquia = $edadMenarquia;

        return $this;
    }

    /**
     * Get edadMenarquia
     *
     * @return integer 
     */
    public function getEdadMenarquia()
    {
        return $this->edadMenarquia;
    }

    /**
     * Set edadInicioRelSexual
     *
     * @param integer $edadInicioRelSexual
     * @return SecAntecedentesObstetricos
     */
    public function setEdadInicioRelSexual($edadInicioRelSexual)
    {
        $this->edadInicioRelSexual = $edadInicioRelSexual;

        return $this;
    }

    /**
     * Get edadInicioRelSexual
     *
     * @return integer 
     */
    public function getEdadInicioRelSexual()
    {
        return $this->edadInicioRelSexual;
    }

    /**
     * Set idAntecedentes
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentes $idAntecedentes
     * @return SecAntecedentesObstetricos
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
}
