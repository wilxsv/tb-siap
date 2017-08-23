<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarFactoresRiesgo
 *
 * @ORM\Table(name="tar_factores_riesgo", indexes={@ORM\Index(name="IDX_FF7F0C4F695EA351", columns={"id_atencion"})})
 * @ORM\Entity
 */
class TarFactoresRiesgo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_factores_riesgo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="clasificacion_factores", type="string", length=3, nullable=false)
     */
    private $clasificacionFactores = 'GEN';

    /**
     * @var \Minsal\SiapsBundle\CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="TarSolicitudFvih", mappedBy="idFactoresRiesgo")
     */
    private $idSolicitudFvih;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idSolicitudFvih = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * @return TarFactoresRiesgo
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
     * Set clasificacionFactores
     *
     * @param string $clasificacionFactores
     * @return TarFactoresRiesgo
     */
    public function setClasificacionFactores($clasificacionFactores)
    {
        $this->clasificacionFactores = $clasificacionFactores;

        return $this;
    }

    /**
     * Get clasificacionFactores
     *
     * @return string 
     */
    public function getClasificacionFactores()
    {
        return $this->clasificacionFactores;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     * @return TarFactoresRiesgo
     */
    public function setIdAtencion(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion = null)
    {
        $this->idAtencion = $idAtencion;

        return $this;
    }

    /**
     * Get idAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion 
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    /**
     * Add idSolicitudFvih
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarSolicitudFvih $idSolicitudFvih
     * @return TarFactoresRiesgo
     */
    public function addIdSolicitudFvih(\Minsal\SeguimientoBundle\Entity\TarSolicitudFvih $idSolicitudFvih)
    {
        $this->idSolicitudFvih[] = $idSolicitudFvih;

        return $this;
    }

    /**
     * Remove idSolicitudFvih
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarSolicitudFvih $idSolicitudFvih
     */
    public function removeIdSolicitudFvih(\Minsal\SeguimientoBundle\Entity\TarSolicitudFvih $idSolicitudFvih)
    {
        $this->idSolicitudFvih->removeElement($idSolicitudFvih);
    }

    /**
     * Get idSolicitudFvih
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdSolicitudFvih()
    {
        return $this->idSolicitudFvih;
    }
    
    function __toString() {
        return $this->nombre?: '';
    }
}
