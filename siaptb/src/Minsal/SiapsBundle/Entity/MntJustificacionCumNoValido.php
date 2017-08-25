<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * MntJustificacionCumNoValido
 *
 * @ORM\Table(name="mnt_justificacion_cum_no_valido")
 * @ORM\Entity
 */
class MntJustificacionCumNoValido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_justificacion_cum_no_valido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=true)
     */
    private $fechaHoraRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="justificacion", type="text", nullable=true)
     */
    private $justificacion;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_registra", referencedColumnName="id",nullable=false)
     * })
     */
    private $idUsuarioRegistra;

    /**
     * @var \MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="MntExpediente", inversedBy="detalleJustificacion",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;


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
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return MntJustificacionCumNoValido
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
     * Set justificacion
     *
     * @param string $justificacion
     * @return MntJustificacionCumNoValido
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string 
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set idUsuarioRegistra
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioRegistra
     * @return MntJustificacionCumNoValido
     */
    public function setIdUsuarioRegistra(\Application\Sonata\UserBundle\Entity\User $idUsuarioRegistra)
    {
        $this->idUsuarioRegistra = $idUsuarioRegistra;

        return $this;
    }

    /**
     * Get idUsuarioRegistra
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUsuarioRegistra()
    {
        return $this->idUsuarioRegistra;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return MntJustificacionCumNoValido
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
}
