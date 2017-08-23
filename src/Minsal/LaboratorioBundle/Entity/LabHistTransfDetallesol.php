<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabHistTransfDetallesol
 *
 * @ORM\Table(name="lab_hist_transf_detallesol", indexes={@ORM\Index(name="IDX_3B47F19EBF4AAADB", columns={"id_estab_origen"}), @ORM\Index(name="IDX_3B47F19EACF26D20", columns={"id_estab_envio"}), @ORM\Index(name="IDX_3B47F19E825FEB10", columns={"id_estado_transferencia"}), @ORM\Index(name="IDX_3B47F19E9F6A6D74", columns={"id_detalle_solicitud_registro"})})
 * @ORM\Entity
 */
class LabHistTransfDetallesol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_hist_transf_detallesol_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_detalle_solicitud_origen", type="integer", nullable=true)
     */
    private $idDetalleSolicitudOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_detalle_solicitud_envio", type="integer", nullable=true)
     */
    private $idDetalleSolicitudEnvio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_envio", type="datetime", nullable=true)
     */
    private $fechaHoraEnvio;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estab_origen", referencedColumnName="id")
     * })
     */
    private $idEstabOrigen;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estab_envio", referencedColumnName="id")
     * })
     */
    private $idEstabEnvio;

    /**
     * @var \LabEstadoTransferencia
     *
     * @ORM\ManyToOne(targetEntity="LabEstadoTransferencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_transferencia", referencedColumnName="id")
     * })
     */
    private $idEstadoTransferencia;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_detalle_solicitud_registro", referencedColumnName="id")
     * })
     */
    private $idDetalleSolicitudRegistro;



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
     * Set idDetalleSolicitudOrigen
     *
     * @param integer $idDetalleSolicitudOrigen
     * @return LabHistTransfDetallesol
     */
    public function setIdDetalleSolicitudOrigen($idDetalleSolicitudOrigen)
    {
        $this->idDetalleSolicitudOrigen = $idDetalleSolicitudOrigen;

        return $this;
    }

    /**
     * Get idDetalleSolicitudOrigen
     *
     * @return integer 
     */
    public function getIdDetalleSolicitudOrigen()
    {
        return $this->idDetalleSolicitudOrigen;
    }

    /**
     * Set idDetalleSolicitudEnvio
     *
     * @param integer $idDetalleSolicitudEnvio
     * @return LabHistTransfDetallesol
     */
    public function setIdDetalleSolicitudEnvio($idDetalleSolicitudEnvio)
    {
        $this->idDetalleSolicitudEnvio = $idDetalleSolicitudEnvio;

        return $this;
    }

    /**
     * Get idDetalleSolicitudEnvio
     *
     * @return integer 
     */
    public function getIdDetalleSolicitudEnvio()
    {
        return $this->idDetalleSolicitudEnvio;
    }

    /**
     * Set fechaHoraEnvio
     *
     * @param \DateTime $fechaHoraEnvio
     * @return LabHistTransfDetallesol
     */
    public function setFechaHoraEnvio($fechaHoraEnvio)
    {
        $this->fechaHoraEnvio = $fechaHoraEnvio;

        return $this;
    }

    /**
     * Get fechaHoraEnvio
     *
     * @return \DateTime 
     */
    public function getFechaHoraEnvio()
    {
        return $this->fechaHoraEnvio;
    }

    /**
     * Set idEstabOrigen
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstabOrigen
     * @return LabHistTransfDetallesol
     */
    public function setIdEstabOrigen(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstabOrigen = null)
    {
        $this->idEstabOrigen = $idEstabOrigen;

        return $this;
    }

    /**
     * Get idEstabOrigen
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstabOrigen()
    {
        return $this->idEstabOrigen;
    }

    /**
     * Set idEstabEnvio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstabEnvio
     * @return LabHistTransfDetallesol
     */
    public function setIdEstabEnvio(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstabEnvio = null)
    {
        $this->idEstabEnvio = $idEstabEnvio;

        return $this;
    }

    /**
     * Get idEstabEnvio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstabEnvio()
    {
        return $this->idEstabEnvio;
    }

    /**
     * Set idEstadoTransferencia
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabEstadoTransferencia $idEstadoTransferencia
     * @return LabHistTransfDetallesol
     */
    public function setIdEstadoTransferencia(\Minsal\LaboratorioBundle\Entity\LabEstadoTransferencia $idEstadoTransferencia = null)
    {
        $this->idEstadoTransferencia = $idEstadoTransferencia;

        return $this;
    }

    /**
     * Get idEstadoTransferencia
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabEstadoTransferencia 
     */
    public function getIdEstadoTransferencia()
    {
        return $this->idEstadoTransferencia;
    }

    /**
     * Set idDetalleSolicitudRegistro
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios $idDetalleSolicitudRegistro
     * @return LabHistTransfDetallesol
     */
    public function setIdDetalleSolicitudRegistro(\Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios $idDetalleSolicitudRegistro = null)
    {
        $this->idDetalleSolicitudRegistro = $idDetalleSolicitudRegistro;

        return $this;
    }

    /**
     * Get idDetalleSolicitudRegistro
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios 
     */
    public function getIdDetalleSolicitudRegistro()
    {
        return $this->idDetalleSolicitudRegistro;
    }
}
