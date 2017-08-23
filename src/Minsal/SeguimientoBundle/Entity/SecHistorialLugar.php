<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecHistorialLugar
 *
 * @ORM\Table(name="sec_historial_lugar", indexes={@ORM\Index(name="IDX_8AAD6DC31827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_8AAD6DCD166B38A", columns={"id_tipo_lugar_trabajo"})})
 * @ORM\Entity
 */
class SecHistorialLugar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_historial_lugar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", nullable=true)
     */
    private $nombre;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\OneToOne(targetEntity="SecHistorialClinico", inversedBy="historialLugar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id", nullable=true)
     * })
     */
    private $idHistorialClinico;

    /**
     * @var \CtlTipoLugarTrabajo
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoLugarTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_lugar_trabajo", referencedColumnName="id")
     * })
     */
    private $idTipoLugarTrabajo;



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
     * @return SecHistorialLugar
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
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecHistorialLugar
     */
    public function setIdHistorialClinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico = null)
    {
        $this->idHistorialClinico = $idHistorialClinico;

        return $this;
    }

    /**
     * Get idHistorialClinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     */
    public function getIdHistorialClinico()
    {
        return $this->idHistorialClinico;
    }

    /**
     * Set idTipoLugarTrabajo
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoLugarTrabajo $idTipoLugarTrabajo
     * @return SecHistorialLugar
     */
    public function setIdTipoLugarTrabajo(\Minsal\SeguimientoBundle\Entity\CtlTipoLugarTrabajo $idTipoLugarTrabajo = null)
    {
        $this->idTipoLugarTrabajo = $idTipoLugarTrabajo;

        return $this;
    }

    /**
     * Get idTipoLugarTrabajo
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoLugarTrabajo
     */
    public function getIdTipoLugarTrabajo()
    {
        return $this->idTipoLugarTrabajo;
    }

    public function __toString() {
        return $this->id ? $this->idTipoLugarTrabajo->getNombre().': '.$this->nombre : '';
    }
}
