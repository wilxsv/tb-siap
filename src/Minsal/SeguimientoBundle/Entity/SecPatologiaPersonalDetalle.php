<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecPatologiaPersonalDetalle
 *
 * @ORM\Table(name="sec_patologia_personal_detalle", indexes={@ORM\Index(name="fki_antec_patol_perso_patol_perso_detal", columns={"id_antecedentes_patologia_personal"})})
 * @ORM\Entity
 */
class SecPatologiaPersonalDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_patologia_personal_detalle_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio_inicio", type="integer", nullable=true)
     */
    private $anioInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="especificacion", type="text", nullable=true)
     */
    private $especificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="medicamento_tomado", type="text", nullable=true)
     */
    private $medicamentoTomado;

    /**
     * @var \SecAntecedentesPatologiaPersonal
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesPatologiaPersonal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes_patologia_personal", referencedColumnName="id")
     * })
     */
    private $idAntecedentesPatologiaPersonal;



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
     * Set anioInicio
     *
     * @param integer $anioInicio
     * @return SecPatologiaPersonalDetalle
     */
    public function setAnioInicio($anioInicio)
    {
        $this->anioInicio = $anioInicio;

        return $this;
    }

    /**
     * Get anioInicio
     *
     * @return integer 
     */
    public function getAnioInicio()
    {
        return $this->anioInicio;
    }

    /**
     * Set especificacion
     *
     * @param string $especificacion
     * @return SecPatologiaPersonalDetalle
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
     * Set medicamentoTomado
     *
     * @param string $medicamentoTomado
     * @return SecPatologiaPersonalDetalle
     */
    public function setMedicamentoTomado($medicamentoTomado)
    {
        $this->medicamentoTomado = $medicamentoTomado;

        return $this;
    }

    /**
     * Get medicamentoTomado
     *
     * @return string 
     */
    public function getMedicamentoTomado()
    {
        return $this->medicamentoTomado;
    }

    /**
     * Set idAntecedentesPatologiaPersonal
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaPersonal $idAntecedentesPatologiaPersonal
     * @return SecPatologiaPersonalDetalle
     */
    public function setIdAntecedentesPatologiaPersonal(\Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaPersonal $idAntecedentesPatologiaPersonal = null)
    {
        $this->idAntecedentesPatologiaPersonal = $idAntecedentesPatologiaPersonal;

        return $this;
    }

    /**
     * Get idAntecedentesPatologiaPersonal
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaPersonal 
     */
    public function getIdAntecedentesPatologiaPersonal()
    {
        return $this->idAntecedentesPatologiaPersonal;
    }
}
