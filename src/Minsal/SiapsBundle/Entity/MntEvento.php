<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntEvento
 *
 * @ORM\Table(name="mnt_evento", indexes={@ORM\Index(name="fki_mnt_ciq_cit_eventos", columns={"id_procedimiento_establecimiento"}), @ORM\Index(name="fki_fos_user_user_reg_cit_evento", columns={"idusuarioreg"}), @ORM\Index(name="fki_cit_tipoevento_cit_evento", columns={"id_tipo_evento"}), @ORM\Index(name="fki_mnt_area_mod_estab_cit_evento", columns={"id_area_mod_estab"}), @ORM\Index(name="fki_ctl_establecimiento_cit_evento", columns={"id_establecimiento"}), @ORM\Index(name="IDX_58F11112CAC67ADB", columns={"id_modulo"}), @ORM\Index(name="IDX_58F11112890253C7", columns={"id_empleado"})})
 * @ORM\Entity
 */
class MntEvento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_evento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_ini", type="datetime", nullable=true)
     */
    private $fechaHoraIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin", type="datetime", nullable=true)
     */
    private $fechaHoraFin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_evento_medico", type="boolean", nullable=true)
     */
    private $esEventoMedico = true;

    /**
     * @var \MntTipoEvento
     *
     * @ORM\ManyToOne(targetEntity="MntTipoEvento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_evento", referencedColumnName="id")
     * })
     */
    private $idTipoEvento;

    /**
     * @var \CtlModulo
     *
     * @ORM\ManyToOne(targetEntity="CtlModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id")
     * })
     */
    private $idModulo;

    /**
     * @var \MntProcedimientoEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="MntProcedimientoEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_establecimiento", referencedColumnName="id")
     * })
     */
    private $idProcedimientoEstablecimiento;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \MntAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="MntAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAreaModEstab;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;



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
     * Set fechaHoraIni
     *
     * @param \DateTime $fechaHoraIni
     * @return MntEvento
     */
    public function setFechaHoraIni($fechaHoraIni)
    {
        $this->fechaHoraIni = $fechaHoraIni;

        return $this;
    }

    /**
     * Get fechaHoraIni
     *
     * @return \DateTime
     */
    public function getFechaHoraIni()
    {
        return $this->fechaHoraIni;
    }

    /**
     * Set fechaHoraFin
     *
     * @param \DateTime $fechaHoraFin
     * @return MntEvento
     */
    public function setFechaHoraFin($fechaHoraFin)
    {
        $this->fechaHoraFin = $fechaHoraFin;

        return $this;
    }

    /**
     * Get fechaHoraFin
     *
     * @return \DateTime
     */
    public function getFechaHoraFin()
    {
        return $this->fechaHoraFin;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return MntEvento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return MntEvento
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
     * Set nombre
     *
     * @param string $nombre
     * @return MntEvento
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
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return MntEvento
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
     * Set esEventoMedico
     *
     * @param boolean $esEventoMedico
     * @return MntEvento
     */
    public function setEsEventoMedico($esEventoMedico)
    {
        $this->esEventoMedico = $esEventoMedico;

        return $this;
    }

    /**
     * Get esEventoMedico
     *
     * @return boolean
     */
    public function getEsEventoMedico()
    {
        return $this->esEventoMedico;
    }

    /**
     * Set idTipoEvento
     *
     * @param \Minsal\SiapsBundle\Entity\MntTipoEvento $idTipoEvento
     * @return MntEvento
     */
    public function setIdTipoEvento(\Minsal\SiapsBundle\Entity\MntTipoEvento $idTipoEvento = null)
    {
        $this->idTipoEvento = $idTipoEvento;

        return $this;
    }

    /**
     * Get idTipoEvento
     *
     * @return \Minsal\SiapsBundle\Entity\MntTipoEvento
     */
    public function getIdTipoEvento()
    {
        return $this->idTipoEvento;
    }

    /**
     * Set idModulo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlModulo $idModulo
     * @return MntEvento
     */
    public function setIdModulo(\Minsal\SiapsBundle\Entity\CtlModulo $idModulo = null)
    {
        $this->idModulo = $idModulo;

        return $this;
    }

    /**
     * Get idModulo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlModulo
     */
    public function getIdModulo()
    {
        return $this->idModulo;
    }

    /**
     * Set idProcedimientoEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento $idProcedimientoEstablecimiento
     * @return MntEvento
     */
    public function setIdProcedimientoEstablecimiento(\Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento $idProcedimientoEstablecimiento = null)
    {
        $this->idProcedimientoEstablecimiento = $idProcedimientoEstablecimiento;

        return $this;
    }

    /**
     * Get idProcedimientoEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\MntProcedimientoEstablecimiento
     */
    public function getIdProcedimientoEstablecimiento()
    {
        return $this->idProcedimientoEstablecimiento;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return MntEvento
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return MntEvento
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
     * Set idAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab
     * @return MntEvento
     */
    public function setIdAreaModEstab(\Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab = null)
    {
        $this->idAreaModEstab = $idAreaModEstab;

        return $this;
    }

    /**
     * Get idAreaModEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAreaModEstab
     */
    public function getIdAreaModEstab()
    {
        return $this->idAreaModEstab;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return MntEvento
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

    public function __toString() {
        return $this->id ? $this->nombre : '';
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return MntEvento
     */
    public function setIdusuariomod(\Application\Sonata\UserBundle\Entity\User $idusuariomod = null)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }
}
