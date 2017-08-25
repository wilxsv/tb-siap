<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabControlInterface
 *
 * @ORM\Table(name="lab_control_interface")
 * @ORM\Entity
 */
class LabControlInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_control_interface_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recibio", type="datetime", nullable=true)
     */
    private $fechaRecibio;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="string", nullable=true)
     */
    private $mensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje_excepcion", type="string", nullable=true)
     */
    private $mensajeExcepcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_proceso", type="datetime", nullable=true)
     */
    private $fechaProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="via", type="integer", nullable=true)
     */
    private $via;

    /**
     * @var integer
     *
     * @ORM\Column(name="terminal", type="integer", nullable=true)
     */
    private $terminal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estandar", type="integer", nullable=true)
     */
    private $estandar;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion", type="integer", nullable=true)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="checksum", type="integer", nullable=true)
     */
    private $checksum;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_solicitudestudios", type="integer", nullable=true)
     */
    private $idSolicitudestudios;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_suministrante", type="integer", nullable=true)
     */
    private $idSuministrante;


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
     * Set fechaRecibio
     *
     * @param \DateTime $fechaRecibio
     * @return LabControlInterface
     */
    public function setFechaRecibio($fechaRecibio)
    {
        $this->fechaRecibio = $fechaRecibio;

        return $this;
    }

    /**
     * Get fechaRecibio
     *
     * @return \DateTime
     */
    public function getFechaRecibio()
    {
        return $this->fechaRecibio;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return LabControlInterface
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set mensajeExcepcion
     *
     * @param string $mensajeExcepcion
     * @return LabControlInterface
     */
    public function setMensajeExcepcion($mensajeExcepcion)
    {
        $this->mensajeExcepcion = $mensajeExcepcion;

        return $this;
    }

    /**
     * Get mensajeExcepcion
     *
     * @return string
     */
    public function getMensajeExcepcion()
    {
        return $this->mensajeExcepcion;
    }

    /**
     * Set fechaProceso
     *
     * @param \DateTime $fechaProceso
     * @return LabControlInterface
     */
    public function setFechaProceso($fechaProceso)
    {
        $this->fechaProceso = $fechaProceso;

        return $this;
    }

    /**
     * Get fechaProceso
     *
     * @return \DateTime
     */
    public function getFechaProceso()
    {
        return $this->fechaProceso;
    }

    /**
     * Set via
     *
     * @param integer $via
     * @return LabControlInterface
     */
    public function setVia($via)
    {
        $this->via = $via;

        return $this;
    }

    /**
     * Get via
     *
     * @return integer
     */
    public function getVia()
    {
        return $this->via;
    }

    /**
     * Set terminal
     *
     * @param integer $terminal
     * @return LabControlInterface
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return integer
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Set estandar
     *
     * @param integer $estandar
     * @return LabControlInterface
     */
    public function setEstandar($estandar)
    {
        $this->estandar = $estandar;

        return $this;
    }

    /**
     * Get estandar
     *
     * @return integer
     */
    public function getEstandar()
    {
        return $this->estandar;
    }

    /**
     * Set accion
     *
     * @param integer $accion
     * @return LabControlInterface
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return integer
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set checksum
     *
     * @param integer $checksum
     * @return LabControlInterface
     */
    public function setChecksum($checksum)
    {
        $this->checksum = $checksum;

        return $this;
    }

    /**
     * Get checksum
     *
     * @return integer
     */
    public function getChecksum()
    {
        return $this->checksum;
    }

    /**
     * Set idSolicitudestudios
     *
     * @param integer $idSolicitudestudios
     * @return LabControlInterface
     */
    public function setIdSolicitudestudios($idSolicitudestudios)
    {
        $this->idSolicitudestudios = $idSolicitudestudios;

        return $this;
    }

    /**
     * Get idSolicitudestudios
     *
     * @return integer
     */
    public function getIdSolicitudestudios()
    {
        return $this->idSolicitudestudios;
    }


    /**
     * Set idSuministrante
     *
     * @param integer $idSuministrante
     * @return LabControlInterface
     */
    public function setIdSuministrante($idSuministrante)
    {
        $this->idSuministrante = $idSuministrante;

        return $this;
    }

    /**
     * Get idSuministrante
     *
     * @return integer
     */
    public function getIdSuministrante()
    {
        return $this->idSuministrante;
    }


    /**
     * Set estado
     *
     * @param integer $estado
     * @return LabControlInterface
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }


}
