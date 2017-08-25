<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlPatologia
 *
 * @ORM\Table(name="ctl_patologia", indexes={@ORM\Index(name="fki_tipo_patologia_patologia", columns={"id_tipo_patologia"}), @ORM\Index(name="fki_patologia_patologia", columns={"id_patologia_padre"})})
 * @ORM\Entity
 */
class CtlPatologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_patologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notificacion", type="boolean", nullable=false)
     */
    private $notificacion = false;

    /**
     * @var \CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patologia_padre", referencedColumnName="id")
     * })
     */
    private $idPatologiaPadre;

    /**
     * @var \CtlTipoPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_patologia", referencedColumnName="id")
     * })
     */
    private $idTipoPatologia;



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
     * @return CtlPatologia
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
     * Set notificacion
     *
     * @param boolean $notificacion
     * @return CtlPatologia
     */
    public function setNotificacion($notificacion)
    {
        $this->notificacion = $notificacion;

        return $this;
    }

    /**
     * Get notificacion
     *
     * @return boolean 
     */
    public function getNotificacion()
    {
        return $this->notificacion;
    }

    /**
     * Set idPatologiaPadre
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlPatologia $idPatologiaPadre
     * @return CtlPatologia
     */
    public function setIdPatologiaPadre(\Minsal\SeguimientoBundle\Entity\CtlPatologia $idPatologiaPadre = null)
    {
        $this->idPatologiaPadre = $idPatologiaPadre;

        return $this;
    }

    /**
     * Get idPatologiaPadre
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlPatologia 
     */
    public function getIdPatologiaPadre()
    {
        return $this->idPatologiaPadre;
    }

    /**
     * Set idTipoPatologia
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoPatologia $idTipoPatologia
     * @return CtlPatologia
     */
    public function setIdTipoPatologia(\Minsal\SeguimientoBundle\Entity\CtlTipoPatologia $idTipoPatologia = null)
    {
        $this->idTipoPatologia = $idTipoPatologia;

        return $this;
    }

    /**
     * Get idTipoPatologia
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoPatologia 
     */
    public function getIdTipoPatologia()
    {
        return $this->idTipoPatologia;
    }
}
