<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitJustificacion
 *
 * @ORM\Table(name="cit_justificacion", indexes={@ORM\Index(name="IDX_BF66A4D442E04C4F", columns={"id_estado_cita"})})
 * @ORM\Entity(repositoryClass="Minsal\CitasBundle\Repositorio\CitJustificacionRepository")
 */
class CitJustificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_justificacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=500, nullable=true)
     */
    private $nombre;

    /**
     * @var \CitEstadoCita
     *
     * @ORM\ManyToOne(targetEntity="CitEstadoCita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_cita", referencedColumnName="id")
     * })
     */
    private $idEstadoCita;



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
     * Set nombre
     *
     * @param string $nombre
     * @return CitJustificacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idEstadoCita
     *
     * @param \Minsal\CitasBundle\Entity\CitEstadoCita $idEstadoCita
     * @return CitJustificacion
     */
    public function setIdEstadoCita(\Minsal\CitasBundle\Entity\CitEstadoCita $idEstadoCita = null)
    {
        $this->idEstadoCita = $idEstadoCita;

        return $this;
    }

    /**
     * Get idEstadoCita
     *
     * @return \Minsal\CitasBundle\Entity\CitEstadoCita
     */
    public function getIdestado()
    {
        return $this->idEstadoCita;
    }

    public function _toString() {
        $this->id ? $this->idEstadoCita.' - '.$this->nombre : '';
    }
}
