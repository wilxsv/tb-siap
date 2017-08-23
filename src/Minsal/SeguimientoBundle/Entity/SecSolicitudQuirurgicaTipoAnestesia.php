<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSolicitudQuirurgicaTipoAnestesia
 *
 * @ORM\Table(name="sec_solicitud_quirurgica_tipo_anestesia", indexes={@ORM\Index(name="IDX_9E7ACD6848709FC9", columns={"id_solicitud_quirurgica"}), @ORM\Index(name="IDX_9E7ACD683BD73BB2", columns={"id_tipo_anestesia"})})
 * @ORM\Entity
 */
class SecSolicitudQuirurgicaTipoAnestesia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_solicitud_quirurgica_tipo_anestesia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \SecSolicitudQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="SecSolicitudQuirurgica", inversedBy="tipoAnestesia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_quirurgica", referencedColumnName="id")
     * })
     */
    private $idSolicitudQuirurgica;

    /**
     * @var \CtlTipoAnestesia
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoAnestesia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_anestesia", referencedColumnName="id")
     * })
     */
    private $idTipoAnestesia;



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
     * @return SecSolicitudQuirurgicaTipoAnestesia
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
     * Set idTipoAnestesia
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoAnestesia $idTipoAnestesia
     * @return SecSolicitudQuirurgicaTipoAnestesia
     */
    public function setIdTipoAnestesia(\Minsal\SeguimientoBundle\Entity\CtlTipoAnestesia $idTipoAnestesia = null)
    {
        $this->idTipoAnestesia = $idTipoAnestesia;

        return $this;
    }

    /**
     * Get idTipoAnestesia
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoAnestesia
     */
    public function getIdTipoAnestesia()
    {
        return $this->idTipoAnestesia;
    }

    public function __toString(){
        return $this->idTipoAnestesia ? $this->idTipoAnestesia->getNombre() : '';
    }
}
