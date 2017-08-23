<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntDatoReferencia
 *
 * @ORM\Table(name="mnt_dato_referencia", indexes={@ORM\Index(name="IDX_1883A6AF3EF1ABD3", columns={"id_expediente_referido"}), @ORM\Index(name="IDX_1883A6AF890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_1883A6AF8627A85B", columns={"id_aten_area_mod_estab"}), @ORM\Index(name="IDX_1883A6AF13B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_1883A6AF7DFA12F6", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class MntDatoReferencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_dato_referencia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_horareg", type="time", nullable=true)
     */
    private $fechaHorareg;

    /**
     * @var \MntExpedienteReferido
     *
     * @ORM\ManyToOne(targetEntity="MntExpedienteReferido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente_referido", referencedColumnName="id")
     * })
     */
    private $idExpedienteReferido;

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
     * @var \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aten_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAtenAreaModEstab;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntCie10
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntCie10")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cie10", referencedColumnName="id")
     * })
     */
    private $idCie10;

    /**
     * @var string
     *
     * @ORM\Column(name="especificacion_diagnostico", type="text", nullable=true)
     */
    private $especificacionDiagnostico;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\CtlTipoDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\CtlTipoDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_diagnostico", referencedColumnName="id")
     * })
     */
    private $idTipoDiagnostico;

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
     * Set fechaHorareg
     *
     * @param \DateTime $fechaHorareg
     * @return MntDatoReferencia
     */
    public function setFechaHorareg($fechaHorareg)
    {
        $this->fechaHorareg = $fechaHorareg;

        return $this;
    }

    /**
     * Get fechaHorareg
     *
     * @return \DateTime
     */
    public function getFechaHorareg()
    {
        return $this->fechaHorareg;
    }

    /**
     * Set idExpedienteReferido
     *
     * @param \Minsal\LaboratorioBundle\Entity\MntExpedienteReferido $idExpedienteReferido
     * @return MntDatoReferencia
     */
    public function setIdExpedienteReferido(\Minsal\LaboratorioBundle\Entity\MntExpedienteReferido $idExpedienteReferido = null)
    {
        $this->idExpedienteReferido = $idExpedienteReferido;

        return $this;
    }

    /**
     * Get idExpedienteReferido
     *
     * @return \Minsal\LaboratorioBundle\Entity\MntExpedienteReferido
     */
    public function getIdExpedienteReferido()
    {
        return $this->idExpedienteReferido;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return MntDatoReferencia
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
     * Set idAtenAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab
     * @return MntDatoReferencia
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return MntDatoReferencia
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
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return MntDatoReferencia
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
     * Set especificacionDiagnostico
     *
     * @param string $especificacionDiagnostico
     * @return MntDatoReferencia
     */
    public function setEspecificacionDiagnostico($especificacionDiagnostico)
    {
        $this->especificacionDiagnostico = $especificacionDiagnostico;

        return $this;
    }

    /**
     * Get especificacionDiagnostico
     *
     * @return string
     */
    public function getEspecificacionDiagnostico()
    {
        return $this->especificacionDiagnostico;
    }

    /**
     * Set idCie10
     *
     * @param \Minsal\SiapsBundle\Entity\MntCie10 $idCie10
     * @return MntDatoReferencia
     */
    public function setIdCie10(\Minsal\SiapsBundle\Entity\MntCie10 $idCie10 = null)
    {
        $this->idCie10 = $idCie10;

        return $this;
    }

    /**
     * Get idCie10
     *
     * @return \Minsal\SiapsBundle\Entity\MntCie10
     */
    public function getIdCie10()
    {
        return $this->idCie10;
    }

    /**
     * Set idTipoDiagnostico
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoDiagnostico $idTipoDiagnostico
     * @return MntDatoReferencia
     */
    public function setIdTipoDiagnostico(\Minsal\SeguimientoBundle\Entity\CtlTipoDiagnostico $idTipoDiagnostico = null)
    {
        $this->idTipoDiagnostico = $idTipoDiagnostico;

        return $this;
    }

    /**
     * Get idTipoDiagnostico
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoDiagnostico
     */
    public function getIdTipoDiagnostico()
    {
        return $this->idTipoDiagnostico;
    }

    public function __toString() {
        return $this->id ? $this->id : '';
    }
}
