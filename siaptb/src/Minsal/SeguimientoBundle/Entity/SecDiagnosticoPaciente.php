<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecDiagnosticoPaciente
 *
 * @ORM\Table(name="sec_diagnostico_paciente", indexes={@ORM\Index(name="IDX_76DABF20F7B24431", columns={"id_cie10_medico"}), @ORM\Index(name="IDX_76DABF2031827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_76DABF204D5E2788", columns={"id_snomed"}), @ORM\Index(name="IDX_76DABF20CE13B472", columns={"id_tipo_consulta"}), @ORM\Index(name="IDX_76DABF204D3FAF61", columns={"id_tipo_diagnostico"})})
 * @ORM\Entity
 */
class SecDiagnosticoPaciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_diagnostico_paciente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cie10_estadista", type="integer", nullable=true)
     */
    private $idCie10Estadista;

    /**
     * @var string
     *
     * @ORM\Column(name="especificacion", type="text", nullable=true)
     */
    private $especificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmado", type="boolean", nullable=true)
     */
    private $confirmado = false;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntCie10
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntCie10")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cie10_medico", referencedColumnName="id")
     * })
     */
    private $idCie10Medico;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico", inversedBy="diagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntSnomedCie10
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntSnomedCie10")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_snomed", referencedColumnName="id")
     * })
     */
    private $idSnomed;

    /**
     * @var \CtlTipoConsulta
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoConsulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_consulta", referencedColumnName="id")
     * })
     */
    private $idTipoConsulta;

    /**
     * @var \CtlTipoDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoDiagnostico")
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
     * Set idCie10Estadista
     *
     * @param integer $idCie10Estadista
     * @return SecDiagnosticoPaciente
     */
    public function setIdCie10Estadista($idCie10Estadista)
    {
        $this->idCie10Estadista = $idCie10Estadista;

        return $this;
    }

    /**
     * Get idCie10Estadista
     *
     * @return integer
     */
    public function getIdCie10Estadista()
    {
        return $this->idCie10Estadista;
    }

    /**
     * Set especificacion
     *
     * @param string $especificacion
     * @return SecDiagnosticoPaciente
     */
    public function setEspecificacion($especificacion)
    {
        $this->especificacion = $especificacion;

        return $this;
    }

    /**
     * Get especificacion
     *
     * @return string
     */
    public function getEspecificacion()
    {
        return $this->especificacion;
    }

    /**
     * Set confirmado
     *
     * @param boolean $confirmado
     * @return SecDiagnosticoPaciente
     */
    public function setConfirmado($confirmado)
    {
        $this->confirmado = $confirmado;

        return $this;
    }

    /**
     * Get confirmado
     *
     * @return boolean
     */
    public function getConfirmado()
    {
        return $this->confirmado;
    }

    /**
     * Set idCie10Medico
     *
     * @param \Minsal\SiapsBundle\Entity\MntCie10 $idCie10Medico
     * @return SecDiagnosticoPaciente
     */
    public function setIdCie10Medico(\Minsal\SiapsBundle\Entity\MntCie10 $idCie10Medico = null)
    {
        $this->idCie10Medico = $idCie10Medico;

        return $this;
    }

    /**
     * Get idCie10Medico
     *
     * @return \Minsal\SiapsBundle\Entity\MntCie10
     */
    public function getIdCie10Medico()
    {
        return $this->idCie10Medico;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecDiagnosticoPaciente
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
     * Set idSnomed
     *
     * @param \Minsal\SiapsBundle\Entity\MntSnomedCie10 $idSnomed
     * @return SecDiagnosticoPaciente
     */
    public function setIdSnomed(\Minsal\SiapsBundle\Entity\MntSnomedCie10 $idSnomed = null)
    {
        $this->idSnomed = $idSnomed;

        return $this;
    }

    /**
     * Get idSnomed
     *
     * @return \Minsal\SiapsBundle\Entity\MntSnomedCie10
     */
    public function getIdSnomed()
    {
        return $this->idSnomed;
    }

    /**
     * Set idTipoConsulta
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoConsulta $idTipoConsulta
     * @return SecDiagnosticoPaciente
     */
    public function setIdTipoConsulta(\Minsal\SeguimientoBundle\Entity\CtlTipoConsulta $idTipoConsulta = null)
    {
        $this->idTipoConsulta = $idTipoConsulta;

        return $this;
    }

    /**
     * Get idTipoConsulta
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoConsulta
     */
    public function getIdTipoConsulta()
    {
        return $this->idTipoConsulta;
    }

    /**
     * Set idTipoDiagnostico
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoDiagnostico $idTipoDiagnostico
     * @return SecDiagnosticoPaciente
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
        return $this->getIdCie10Medico() ? $this->getIdCie10Medico()->getDiagnostico() : '';
    }
}
