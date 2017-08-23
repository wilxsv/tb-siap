<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSolicitudQuirurgicaProcedimiento
 *
 * @ORM\Table(name="sec_solicitud_quirurgica_procedimiento", indexes={@ORM\Index(name="IDX_39BAD3A648709FC9", columns={"id_solicitud_quirurgica"}), @ORM\Index(name="IDX_39BAD3A6B849D575", columns={"id_ciq"})})
 * @ORM\Entity
 */
class SecSolicitudQuirurgicaProcedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_solicitud_quirurgica_procedimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecSolicitudQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="SecSolicitudQuirurgica", inversedBy="procedimientoQuirurgico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_quirurgica", referencedColumnName="id")
     * })
     */
    private $idSolicitudQuirurgica;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntCiq
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntCiq")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciq", referencedColumnName="id")
     * })
     */
    private $idCiq;



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
     * Set idSolicitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica $idSolicitudQuirurgica
     * @return SecSolicitudQuirurgicaProcedimiento
     */
    public function setIdSolicitudQuirurgica(\Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica $idSolicitudQuirurgica = null)
    {
        $this->idSolicitudQuirurgica = $idSolicitudQuirurgica;

        return $this;
    }

    /**
     * Get idSolicitudQuirurgica
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica
     */
    public function getIdSolicitudQuirurgica()
    {
        return $this->idSolicitudQuirurgica;
    }

    /**
     * Set idCiq
     *
     * @param \Minsal\SiapsBundle\Entity\MntCiq $idCiq
     * @return SecSolicitudQuirurgicaProcedimiento
     */
    public function setIdCiq(\Minsal\SiapsBundle\Entity\MntCiq $idCiq = null)
    {
        $this->idCiq = $idCiq;

        return $this;
    }

    /**
     * Get idCiq
     *
     * @return \Minsal\SiapsBundle\Entity\MntCiq
     */
    public function getIdCiq()
    {
        return $this->idCiq;
    }

    public function __toString(){
        return $this->idCiq ? $this->idCiq->getProcedimiento() : '';
    }
}
