<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * MntExpediente
 *
 * @ORM\Table(name="mnt_expediente")
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repositorio\MntExpedienteRepository")
 */
class MntExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_expediente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=25, nullable=false)
     * @Assert\NotBlank()
     */
    private $numero;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=false)
     */
    private $habilitado = true;

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
     * @var boolean
     *
     * @ORM\Column(name="numero_temporal", type="boolean", nullable=true)
     */
    private $numeroTemporal = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="expediente_fisico_eliminado", type="boolean", nullable=true)
     */
    private $expedienteFisicoEliminado = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cun", type="boolean", nullable=true)
     */
    private $cun = false;

    /**
     * @var \CtlCreacionExpediente
     *
     * @ORM\ManyToOne(targetEntity="CtlCreacionExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_creacion_expediente", referencedColumnName="id")
     * })
     */
    private $idCreacionExpediente;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="MntPaciente", inversedBy="expedientes",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="MntJustificacionCumNoValido", mappedBy="idExpediente", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $detalleJustificacion;



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
     * @return MntExpediente
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
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return MntExpediente
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return MntExpediente
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
     * @return MntExpediente
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
     * Set numeroTemporal
     *
     * @param boolean $numeroTemporal
     * @return MntExpediente
     */
    public function setNumeroTemporal($numeroTemporal)
    {
        $this->numeroTemporal = $numeroTemporal;

        return $this;
    }

    /**
     * Get numeroTemporal
     *
     * @return boolean
     */
    public function getNumeroTemporal()
    {
        return $this->numeroTemporal;
    }

    /**
     * Set idCreacionExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\CtlCreacionExpediente $idCreacionExpediente
     * @return MntExpediente
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
     * @return MntExpediente
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
     * Set idPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\MntPaciente $idPaciente
     * @return MntExpediente
     */
    public function setIdPaciente(\Minsal\SiapsBundle\Entity\MntPaciente $idPaciente = null)
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    /**
     * Get idPaciente
     *
     * @return \Minsal\SiapsBundle\Entity\MntPaciente
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    public function __toString() {
        return $this->numero ? $this->numero : '';
    }

    /**
     * Set expedienteFisicoEliminado
     *
     * @param boolean $expedienteFisicoEliminado
     * @return MntExpediente
     */
    public function setExpedienteFisicoEliminado($expedienteFisicoEliminado)
    {
        $this->expedienteFisicoEliminado = $expedienteFisicoEliminado;

        return $this;
    }

    /**
     * Get expedienteFisicoEliminado
     *
     * @return boolean
     */
    public function getExpedienteFisicoEliminado()
    {
        return $this->expedienteFisicoEliminado;
    }

    /**
     * Set cun
     *
     * @param boolean $cun
     * @return MntExpediente
     */
    public function setCun($cun)
    {
        $this->cun = $cun;

        return $this;
    }

    /**
     * Get cun
     *
     * @return boolean
     */
    public function getCun()
    {
        return $this->cun;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalleJustificacion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add detalleJustificacion
     *
     * @param \Minsal\SiapsBundle\Entity\MntJustificacionCumNoValido $detalleJustificacion
     * @return MntExpediente
     */
    public function addDetalleJustificacion(\Minsal\SiapsBundle\Entity\MntJustificacionCumNoValido $detalleJustificacion)
    {
        $this->detalleJustificacion[] = $detalleJustificacion;

        return $this;
    }

    /**
     * Remove detalleJustificacion
     *
     * @param \Minsal\SiapsBundle\Entity\MntJustificacionCumNoValido $detalleJustificacion
     */
    public function removeDetalleJustificacion(\Minsal\SiapsBundle\Entity\MntJustificacionCumNoValido $detalleJustificacion)
    {
        $this->detalleJustificacion->removeElement($detalleJustificacion);
    }

    /**
     * Get detalleJustificacion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetalleJustificacion()
    {
        return $this->detalleJustificacion;
    }
}
