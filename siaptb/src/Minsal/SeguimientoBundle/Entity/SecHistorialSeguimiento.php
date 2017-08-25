<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecHistorialSeguimiento
 *
 * @ORM\Table(name="sec_historial_seguimiento", indexes={@ORM\Index(name="IDX_8161314FC2346D6B", columns={"id_historial_clinico_origen"}), @ORM\Index(name="IDX_8161314F43148C86", columns={"id_historial_clinico_subsiguiente"})})
 * @ORM\Entity
 */
class SecHistorialSeguimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_historial_seguimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico_origen", referencedColumnName="id")
     * })
     */
    private $idHistorialClinicoOrigen;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico_subsiguiente", referencedColumnName="id")
     * })
     */
    private $idHistorialClinicoSubsiguiente;



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
     * Set idHistorialClinicoOrigen
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinicoOrigen
     * @return SecHistorialSeguimiento
     */
    public function setIdHistorialClinicoOrigen(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinicoOrigen = null)
    {
        $this->idHistorialClinicoOrigen = $idHistorialClinicoOrigen;

        return $this;
    }

    /**
     * Get idHistorialClinicoOrigen
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico 
     */
    public function getIdHistorialClinicoOrigen()
    {
        return $this->idHistorialClinicoOrigen;
    }

    /**
     * Set idHistorialClinicoSubsiguiente
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinicoSubsiguiente
     * @return SecHistorialSeguimiento
     */
    public function setIdHistorialClinicoSubsiguiente(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinicoSubsiguiente = null)
    {
        $this->idHistorialClinicoSubsiguiente = $idHistorialClinicoSubsiguiente;

        return $this;
    }

    /**
     * Get idHistorialClinicoSubsiguiente
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico 
     */
    public function getIdHistorialClinicoSubsiguiente()
    {
        return $this->idHistorialClinicoSubsiguiente;
    }
}
