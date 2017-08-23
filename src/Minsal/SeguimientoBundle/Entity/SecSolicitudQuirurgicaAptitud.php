<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSolicitudQuirurgicaAptitud
 *
 * @ORM\Table(name="sec_solicitud_quirurgica_aptitud", indexes={@ORM\Index(name="IDX_C30C9322798686A2", columns={"id_aptitud_quirurgica"}), @ORM\Index(name="IDX_C30C9322890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_C30C932248709FC9", columns={"id_solicitud_quirurgica"})})
 * @ORM\Entity
 */
class SecSolicitudQuirurgicaAptitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_solicitud_quirurgica_aptitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=false)
     */
    private $fechaHoraRegistro = 'seconds';

    /**
     * @var \CtlAptitudQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="CtlAptitudQuirurgica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aptitud_quirurgica", referencedColumnName="id")
     * })
     */
    private $idAptitudQuirurgica;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

    /**
     * @var \SecSolicitudQuirurgica
     *
     * @ORM\ManyToOne(targetEntity="SecSolicitudQuirurgica", inversedBy="aptitudQuirurgica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_quirurgica", referencedColumnName="id")
     * })
     */
    private $idSolicitudQuirurgica;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;

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
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return SecSolicitudQuirurgicaAptitud
     */
    public function setFechaHoraRegistro($fechaHoraRegistro)
    {
        $this->fechaHoraRegistro = $fechaHoraRegistro;

        return $this;
    }

    /**
     * Get fechaHoraRegistro
     *
     * @return \DateTime
     */
    public function getFechaHoraRegistro()
    {
        return $this->fechaHoraRegistro;
    }

    /**
     * Set idAptitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlAptitudQuirurgica $idAptitudQuirurgica
     * @return SecSolicitudQuirurgicaAptitud
     */
    public function setIdAptitudQuirurgica(\Minsal\SeguimientoBundle\Entity\CtlAptitudQuirurgica $idAptitudQuirurgica = null)
    {
        $this->idAptitudQuirurgica = $idAptitudQuirurgica;

        return $this;
    }

    /**
     * Get idAptitudQuirurgica
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlAptitudQuirurgica
     */
    public function getIdAptitudQuirurgica()
    {
        return $this->idAptitudQuirurgica;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return SecSolicitudQuirurgicaAptitud
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    /**
     * Set idSolicitudQuirurgica
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudQuirurgica $idSolicitudQuirurgica
     * @return SecSolicitudQuirurgicaAptitud
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
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecSolicitudQuirurgicaAptitud
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

    public function __toString(){
        return $this->idAptitudQuirurgica ? $this->idAptitudQuirurgica : '';
    }
}
