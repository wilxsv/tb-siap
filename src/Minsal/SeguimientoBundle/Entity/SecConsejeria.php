<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecConsejeria
 *
 * @ORM\Table(name="sec_consejeria", indexes={@ORM\Index(name="IDX_1FB4531D8627A85B", columns={"id_aten_area_mod_estab"}), @ORM\Index(name="IDX_1FB4531D890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_1FB4531D31827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_1FB4531D6405EBC5", columns={"id_tipo_consejeria"})})
 * @ORM\Entity
 */
class SecConsejeria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_consejeria_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="consejo", type="text", nullable=true)
     */
    private $consejo;

    /**
     * @var \Minsal\SiapsBundle\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aten_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAtenAreaModEstab;

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
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;

    /**
     * @var \CtlTipoConsejeria
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoConsejeria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_consejeria", referencedColumnName="id")
     * })
     */
    private $idTipoConsejeria;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=true)
     */
    private $fechaHoraRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="consejo_anterior", type="text", nullable=true)
     */
    private $consejoAnterior;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;


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
     * Set consejo
     *
     * @param string $consejo
     * @return SecConsejeria
     */
    public function setConsejo($consejo)
    {
        $this->consejo = $consejo;

        return $this;
    }

    /**
     * Get consejo
     *
     * @return string
     */
    public function getConsejo()
    {
        return $this->consejo;
    }

    /**
     * Set idAtenAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab
     * @return SecConsejeria
     */
    public function setIdAtenAreaModEstab(\Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab = null)
    {
        $this->idAtenAreaModEstab = $idAtenAreaModEstab;

        return $this;
    }

    /**
     * Get idAtenAreaModEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     */
    public function getIdAtenAreaModEstab()
    {
        return $this->idAtenAreaModEstab;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return SecConsejeria
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
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecConsejeria
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
     * Set idTipoConsejeria
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoConsejeria $idTipoConsejeria
     * @return SecConsejeria
     */
    public function setIdTipoConsejeria(\Minsal\SeguimientoBundle\Entity\CtlTipoConsejeria $idTipoConsejeria = null)
    {
        $this->idTipoConsejeria = $idTipoConsejeria;

        return $this;
    }

    /**
     * Get idTipoConsejeria
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoConsejeria
     */
    public function getIdTipoConsejeria()
    {
        return $this->idTipoConsejeria;
    }

    /**
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return SecConsejeria
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
     * Set consejoAnterior
     *
     * @param string $consejoAnterior
     * @return SecConsejeria
     */
    public function setConsejoAnterior($consejoAnterior)
    {
        $this->consejoAnterior = $consejoAnterior;

        return $this;
    }

    /**
     * Get consejoAnterior
     *
     * @return string
     */
    public function getConsejoAnterior()
    {
        return $this->consejoAnterior;
    }

    /**
     * Set fechaHoraMod
     *
     * @param \DateTime $fechaHoraMod
     * @return SecConsejeria
     */
    public function setFechaHoraMod($fechaHoraMod)
    {
        $this->fechaHoraMod = $fechaHoraMod;

        return $this;
    }

    /**
     * Get fechaHoraMod
     *
     * @return \DateTime
     */
    public function getFechaHoraMod()
    {
        return $this->fechaHoraMod;
    }
}
