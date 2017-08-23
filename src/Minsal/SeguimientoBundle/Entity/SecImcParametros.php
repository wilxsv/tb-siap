<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecImcParametros
 *
 * @ORM\Table(name="sec_imc_parametros", indexes={@ORM\Index(name="IDX_D5E4870D9CC1698E", columns={"id_condicion_persona"}), @ORM\Index(name="IDX_D5E4870D422A96FE", columns={"id_rango_edad"}), @ORM\Index(name="IDX_D5E4870DA7194A90", columns={"id_sexo"})})
 * @ORM\Entity
 */
class SecImcParametros
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_imc_parametros_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \CtlCondicionPersona
     *
     * @ORM\ManyToOne(targetEntity="CtlCondicionPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_condicion_persona", referencedColumnName="id")
     * })
     */
    private $idCondicionPersona;

    /**
     * @var \CtlRangoEdad
     *
     * @ORM\ManyToOne(targetEntity="CtlRangoEdad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rango_edad", referencedColumnName="id")
     * })
     */
    private $idRangoEdad;

    /**
     * @var \CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;



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
     * Set idCondicionPersona
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlCondicionPersona $idCondicionPersona
     * @return SecImcParametros
     */
    public function setIdCondicionPersona(\Minsal\SeguimientoBundle\Entity\CtlCondicionPersona $idCondicionPersona = null)
    {
        $this->idCondicionPersona = $idCondicionPersona;

        return $this;
    }

    /**
     * Get idCondicionPersona
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlCondicionPersona 
     */
    public function getIdCondicionPersona()
    {
        return $this->idCondicionPersona;
    }

    /**
     * Set idRangoEdad
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idRangoEdad
     * @return SecImcParametros
     */
    public function setIdRangoEdad(\Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idRangoEdad = null)
    {
        $this->idRangoEdad = $idRangoEdad;

        return $this;
    }

    /**
     * Get idRangoEdad
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlRangoEdad 
     */
    public function getIdRangoEdad()
    {
        return $this->idRangoEdad;
    }

    /**
     * Set idSexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idSexo
     * @return SecImcParametros
     */
    public function setIdSexo(\Minsal\SiapsBundle\Entity\CtlSexo $idSexo = null)
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    /**
     * Get idSexo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlSexo 
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }
}
