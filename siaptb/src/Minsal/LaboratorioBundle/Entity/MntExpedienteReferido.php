<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntExpedienteReferido
 *
 * @ORM\Table(name="mnt_expediente_referido", indexes={@ORM\Index(name="IDX_56FC0F12CC9E1B67", columns={"id_creacion_expediente"}), @ORM\Index(name="IDX_56FC0F127DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_56FC0F125916625F", columns={"id_establecimiento_origen"}), @ORM\Index(name="IDX_56FC0F12D7D198FB", columns={"id_referido"})})
 * @ORM\Entity
 */
class MntExpedienteReferido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_expediente_referido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=15, nullable=false)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_creacion", type="time", nullable=true)
     */
    private $horaCreacion;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlCreacionExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlCreacionExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_creacion_expediente", referencedColumnName="id")
     * })
     */
    private $idCreacionExpediente;

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
     *   @ORM\JoinColumn(name="id_establecimiento_origen", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoOrigen;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntPacienteReferido
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntPacienteReferido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_referido", referencedColumnName="id")
     * })
     */
    private $idReferido;



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
     * Set numero
     *
     * @param string $numero
     * @return MntExpedienteReferido
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return MntExpedienteReferido
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set horaCreacion
     *
     * @param \DateTime $horaCreacion
     * @return MntExpedienteReferido
     */
    public function setHoraCreacion($horaCreacion)
    {
        $this->horaCreacion = $horaCreacion;

        return $this;
    }

    /**
     * Get horaCreacion
     *
     * @return \DateTime
     */
    public function getHoraCreacion()
    {
        return $this->horaCreacion;
    }

    /**
     * Set idCreacionExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\CtlCreacionExpediente $idCreacionExpediente
     * @return MntExpedienteReferido
     */
    public function setIdCreacionExpediente(\Minsal\SiapsBundle\Entity\CtlCreacionExpediente $idCreacionExpediente = null)
    {
        $this->idCreacionExpediente = $idCreacionExpediente;

        return $this;
    }

    /**
     * Get idCreacionExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\CtlCreacionExpediente
     */
    public function getIdCreacionExpediente()
    {
        return $this->idCreacionExpediente;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return MntExpedienteReferido
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
     * Set idEstablecimientoOrigen
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoOrigen
     * @return MntExpedienteReferido
     */
    public function setIdEstablecimientoOrigen(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoOrigen = null)
    {
        $this->idEstablecimientoOrigen = $idEstablecimientoOrigen;

        return $this;
    }

    /**
     * Get idEstablecimientoOrigen
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoOrigen()
    {
        return $this->idEstablecimientoOrigen;
    }

    /**
     * Set idReferido
     *
     * @param \Minsal\SiapsBundle\Entity\MntPacienteReferido $idReferido
     * @return MntExpedienteReferido
     */
    public function setIdReferido(\Minsal\SiapsBundle\Entity\MntPacienteReferido $idReferido = null)
    {
        $this->idReferido = $idReferido;

        return $this;
    }

    /**
     * Get idReferido
     *
     * @return \Minsal\SiapsBundle\Entity\MntPacienteReferido
     */
    public function getIdReferido()
    {
        return $this->idReferido;
    }
}
