<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitCitasProcedimientos
 *
 * @ORM\Table(name="cit_citas_procedimientos", indexes={@ORM\Index(name="fki_fos_user_user_reg_cit_citasprocedimientos", columns={"idusuarioreg"}), @ORM\Index(name="IDX_B90B67846A540E", columns={"id_estado"}), @ORM\Index(name="IDX_B90B67847DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_B90B6784D5F9D21F", columns={"id_establecimiento_referencia"}), @ORM\Index(name="IDX_B90B6784701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_B90B67842B148D47", columns={"id_distribucion_procedimiento"})})
 * @ORM\Entity
 */
class CitCitasProcedimientos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_citas_procedimientos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var string
     *
     * @ORM\Column(name="ipcita", type="string", length=15, nullable=true)
     */
    private $ipcita;

    /**
     * @var string
     *
     * @ORM\Column(name="ipconfirmada", type="string", length=15, nullable=true)
     */
    private $ipconfirmada;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_expediente_referencia", type="string", length=20, nullable=true)
     */
    private $numeroExpedienteReferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuariomod", type="integer", nullable=true)
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="date", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var \Minsal\CitasBundle\Entity\CitEstadoCita
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitEstadoCita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_referencia", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoReferencia;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @var \Minsal\CitasBundle\Entity\CitDistribucionProcedimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitDistribucionProcedimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_distribucion_procedimiento", referencedColumnName="id")
     * })
     */
    private $idDistribucionProcedimiento;

    /**
     * @var \CitJustificacion
     *
     * @ORM\ManyToOne(targetEntity="CitJustificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_justificacion", referencedColumnName="id")
     * })
     */
    private $idJustificacion;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return CitCitasProcedimientos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CitCitasProcedimientos
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set ipcita
     *
     * @param string $ipcita
     * @return CitCitasProcedimientos
     */
    public function setIpcita($ipcita)
    {
        $this->ipcita = $ipcita;

        return $this;
    }

    /**
     * Get ipcita
     *
     * @return string
     */
    public function getIpcita()
    {
        return $this->ipcita;
    }

    /**
     * Set ipconfirmada
     *
     * @param string $ipconfirmada
     * @return CitCitasProcedimientos
     */
    public function setIpconfirmada($ipconfirmada)
    {
        $this->ipconfirmada = $ipconfirmada;

        return $this;
    }

    /**
     * Get ipconfirmada
     *
     * @return string
     */
    public function getIpconfirmada()
    {
        return $this->ipconfirmada;
    }

    /**
     * Set numeroExpedienteReferencia
     *
     * @param string $numeroExpedienteReferencia
     * @return CitCitasProcedimientos
     */
    public function setNumeroExpedienteReferencia($numeroExpedienteReferencia)
    {
        $this->numeroExpedienteReferencia = $numeroExpedienteReferencia;

        return $this;
    }

    /**
     * Get numeroExpedienteReferencia
     *
     * @return string
     */
    public function getNumeroExpedienteReferencia()
    {
        return $this->numeroExpedienteReferencia;
    }

    /**
     * Set idusuariomod
     *
     * @param integer $idusuariomod
     * @return CitCitasProcedimientos
     */
    public function setIdusuariomod($idusuariomod)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return integer
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return CitCitasProcedimientos
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set idEstado
     *
     * @param \Minsal\CitasBundle\Entity\CitEstadoCita $idEstado
     * @return CitCitasProcedimientos
     */
    public function setIdEstado(\Minsal\CitasBundle\Entity\CitEstadoCita $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return \Minsal\CitasBundle\Entity\CitEstadoCita
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return CitCitasProcedimientos
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idEstablecimientoReferencia
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoReferencia
     * @return CitCitasProcedimientos
     */
    public function setIdEstablecimientoReferencia(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoReferencia = null)
    {
        $this->idEstablecimientoReferencia = $idEstablecimientoReferencia;

        return $this;
    }

    /**
     * Get idEstablecimientoReferencia
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoReferencia()
    {
        return $this->idEstablecimientoReferencia;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return CitCitasProcedimientos
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return CitCitasProcedimientos
     */
    public function setIdExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idExpediente = null)
    {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente
     */
    public function getIdExpediente()
    {
        return $this->idExpediente;
    }

    /**
     * Set idDistribucionProcedimiento
     *
     * @param \Minsal\CitasBundle\Entity\CitDistribucionProcedimiento $idDistribucionProcedimiento
     * @return CitCitasProcedimientos
     */
    public function setIdDistribucionProcedimiento(\Minsal\CitasBundle\Entity\CitDistribucionProcedimiento $idDistribucionProcedimiento = null)
    {
        $this->idDistribucionProcedimiento = $idDistribucionProcedimiento;

        return $this;
    }

    /**
     * Get idDistribucionProcedimiento
     *
     * @return \Minsal\CitasBundle\Entity\CitDistribucionProcedimiento
     */
    public function getIdDistribucionProcedimiento()
    {
        return $this->idDistribucionProcedimiento;
    }

    /**
     * Set idJustificacion
     *
     * @param \Minsal\CitasBundle\Entity\CitJustificacion $idJustificacion
     * @return CitCitasProcedimientos
     */
    public function setIdJustificacion(\Minsal\CitasBundle\Entity\CitJustificacion $idJustificacion = null)
    {
        $this->idJustificacion = $idJustificacion;

        return $this;
    }

    /**
     * Get idJustificacion
     *
     * @return \Minsal\CitasBundle\Entity\CitJustificacion 
     */
    public function getIdJustificacion()
    {
        return $this->idJustificacion;
    }
}
