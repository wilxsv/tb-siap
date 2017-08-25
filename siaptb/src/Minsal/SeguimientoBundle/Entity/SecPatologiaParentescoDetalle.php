<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecPatologiaParentescoDetalle
 *
 * @ORM\Table(name="sec_patologia_parentesco_detalle", indexes={@ORM\Index(name="fki_antec_patol_paren_patol_paren_detal", columns={"id_detalle_parentesco"}), @ORM\Index(name="fki_parentesco_patologia_parentesco_detalle", columns={"id_parentesco"})})
 * @ORM\Entity
 */
class SecPatologiaParentescoDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_patologia_parentesco_detalle_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecAntecedentesPatologiaParentesco
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesPatologiaParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_detalle_parentesco", referencedColumnName="id")
     * })
     */
    private $idDetalleParentesco;

    /**
     * @var \Minsal\SiapsBundle\CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parentesco", referencedColumnName="id")
     * })
     */
    private $idParentesco;



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
     * Set idDetalleParentesco
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaParentesco $idDetalleParentesco
     * @return SecPatologiaParentescoDetalle
     */
    public function setIdDetalleParentesco(\Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaParentesco $idDetalleParentesco = null)
    {
        $this->idDetalleParentesco = $idDetalleParentesco;

        return $this;
    }

    /**
     * Get idDetalleParentesco
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesPatologiaParentesco 
     */
    public function getIdDetalleParentesco()
    {
        return $this->idDetalleParentesco;
    }

    /**
     * Set idParentesco
     *
     * @param \Minsal\SiapsBundle\Entity\CtlParentesco $idParentesco
     * @return SecPatologiaParentescoDetalle
     */
    public function setIdParentesco(\Minsal\SiapsBundle\Entity\CtlParentesco $idParentesco = null)
    {
        $this->idParentesco = $idParentesco;

        return $this;
    }

    /**
     * Get idParentesco
     *
     * @return \Minsal\SiapsBundle\Entity\CtlParentesco 
     */
    public function getIdParentesco()
    {
        return $this->idParentesco;
    }
}
