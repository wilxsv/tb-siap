<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesOtroDetalle
 *
 * @ORM\Table(name="sec_antecedentes_otro_detalle", indexes={@ORM\Index(name="fki_antecedentes_otro_antecedentes_otro_detalle", columns={"id_antecedentes_otros"})})
 * @ORM\Entity
 */
class SecAntecedentesOtroDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_otro_detalle_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="especificacion", type="text", nullable=true)
     */
    private $especificacion;

    /**
     * @var \SecAntecedentesOtro
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesOtro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes_otros", referencedColumnName="id")
     * })
     */
    private $idAntecedentesOtros;



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
     * Set especificacion
     *
     * @param string $especificacion
     * @return SecAntecedentesOtroDetalle
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
     * Set idAntecedentesOtros
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesOtro $idAntecedentesOtros
     * @return SecAntecedentesOtroDetalle
     */
    public function setIdAntecedentesOtros(\Minsal\SeguimientoBundle\Entity\SecAntecedentesOtro $idAntecedentesOtros = null)
    {
        $this->idAntecedentesOtros = $idAntecedentesOtros;

        return $this;
    }

    /**
     * Get idAntecedentesOtros
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesOtro 
     */
    public function getIdAntecedentesOtros()
    {
        return $this->idAntecedentesOtros;
    }
}
