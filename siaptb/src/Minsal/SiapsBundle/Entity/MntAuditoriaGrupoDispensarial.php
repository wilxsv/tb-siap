<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntAuditoriaGrupoDispensarial
 *
 * @ORM\Table(name="mnt_auditoria_grupo_dispensarial", indexes={@ORM\Index(name="IDX_62D934794158AF49", columns={"id_grupo_dispensarial_anterior"}), @ORM\Index(name="IDX_62D93479961045CB", columns={"id_paciente"}), @ORM\Index(name="IDX_62D93479B7A94012", columns={"id_usuario_cambio"})})
 * @ORM\Entity
 */
class MntAuditoriaGrupoDispensarial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_auditoria_grupo_dispensarial_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_cambio", type="datetime", nullable=false)
     */
    private $fechaHoraCambio;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;

    /**
     * @var \CtlGrupoDispensarial
     *
     * @ORM\ManyToOne(targetEntity="CtlGrupoDispensarial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_dispensarial_anterior", referencedColumnName="id")
     * })
     */
    private $idGrupoDispensarialAnterior;

    /**
     * @var \MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="MntPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;

   /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_cambio", referencedColumnName="id",nullable=false)
     * })
     */
    private $idUsuarioCambio;



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
     * Set fechaHoraCambio
     *
     * @param \DateTime $fechaHoraCambio
     * @return MntAuditoriaGrupoDispensarial
     */
    public function setFechaHoraCambio($fechaHoraCambio)
    {
        $this->fechaHoraCambio = $fechaHoraCambio;

        return $this;
    }

    /**
     * Get fechaHoraCambio
     *
     * @return \DateTime 
     */
    public function getFechaHoraCambio()
    {
        return $this->fechaHoraCambio;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return MntAuditoriaGrupoDispensarial
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
     * Set idGrupoDispensarialAnterior
     *
     * @param \Minsal\SiapsBundle\Entity\CtlGrupoDispensarial $idGrupoDispensarialAnterior
     * @return MntAuditoriaGrupoDispensarial
     */
    public function setIdGrupoDispensarialAnterior(\Minsal\SiapsBundle\Entity\CtlGrupoDispensarial $idGrupoDispensarialAnterior = null)
    {
        $this->idGrupoDispensarialAnterior = $idGrupoDispensarialAnterior;

        return $this;
    }

    /**
     * Get idGrupoDispensarialAnterior
     *
     * @return \Minsal\SiapsBundle\Entity\CtlGrupoDispensarial 
     */
    public function getIdGrupoDispensarialAnterior()
    {
        return $this->idGrupoDispensarialAnterior;
    }

    /**
     * Set idPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\MntPaciente $idPaciente
     * @return MntAuditoriaGrupoDispensarial
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

    /**
     * Set idUsuarioCambio
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioCambio
     * @return MntAuditoriaGrupoDispensarial
     */
    public function setIdUsuarioCambio(\Application\Sonata\UserBundle\Entity\User $idUsuarioCambio)
    {
        $this->idUsuarioCambio = $idUsuarioCambio;

        return $this;
    }

    /**
     * Get idUsuarioCambio
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUsuarioCambio()
    {
        return $this->idUsuarioCambio;
    }
}
