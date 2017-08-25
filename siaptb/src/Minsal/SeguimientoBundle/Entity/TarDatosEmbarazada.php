<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarDatosEmbarazada
 *
 * @ORM\Table(name="tar_datos_embarazada", indexes={@ORM\Index(name="IDX_32BE534D31827296", columns={"id_solicitud"})})
 * @ORM\Entity
 */
class TarDatosEmbarazada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_datos_embarazada_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="control_prenatal", type="boolean", nullable=false)
     */
    private $controlPrenatal;

  
      /**
     * @var \TarSolicitudFvih
     *
     * @ORM\OneToOne(targetEntity="TarSolicitudFvih",inversedBy="idDatoEmbarazo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud", referencedColumnName="id")
     * })
     */

    private $idSolicitud;

    /**
     * @var \TarPeriodosExamen
     *
     * @ORM\OneToOne(targetEntity="TarPeriodosExamen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periodo", referencedColumnName="id")
     * })
     */

    private $idPeriodo;



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
     * Set controlPrenatal
     *
     * @param boolean $controlPrenatal
     * @return TarDatosEmbarazada
     */
    public function setControlPrenatal($controlPrenatal)
    {
        $this->controlPrenatal = $controlPrenatal;

        return $this;
    }

    /**
     * Get controlPrenatal
     *
     * @return boolean 
     */
    public function getControlPrenatal()
    {
        return $this->controlPrenatal;
    }

    /**
     * Set idSolicitud
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarSolicitudFvih $idSolicitud
     * @return TarDatosEmbarazada
     */
    public function setIdSolicitud(\Minsal\SeguimientoBundle\Entity\TarSolicitudFvih $idSolicitud = null)
    {
        $this->idSolicitud = $idSolicitud;

        return $this;
    }

    /**
     * Get idSolicitud
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarSolicitudFvih 
     */
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    /**
     * Set idPeriodo
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarPeriodosExamen $idPeriodo
     * @return TarDatosEmbarazada
     */
    public function setIdPeriodo(\Minsal\SeguimientoBundle\Entity\TarPeriodosExamen $idPeriodo = null)
    {
        $this->idPeriodo = $idPeriodo;

        return $this;
    }

    /**
     * Get idPeriodo
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarPeriodosExamen 
     */
    public function getIdPeriodo()
    {
        return $this->idPeriodo;
    }
}
