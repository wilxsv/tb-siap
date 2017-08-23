<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntAuditoriaSeguimiento
 *
 * @ORM\Table(name="mnt_auditoria_seguimiento", indexes={@ORM\Index(name="IDX_CD87EB89FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class MntAuditoriaSeguimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_auditoria_seguimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_tipo_accion_bitacora", type="string", length=2, nullable=false)
     */
    private $idTipoAccionBitacora;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_afectada", type="text", nullable=true)
     */
    private $tablaAfectada;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_registro_afectado", type="integer", nullable=true)
     */
    private $idRegistroAfectado;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_afectados", type="text", nullable=true)
     */
    private $camposAfectados;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=false)
     */
    private $fechaHoraRegistro;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;



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
     * Set idTipoAccionBitacora
     *
     * @param string $idTipoAccionBitacora
     * @return MntAuditoriaSeguimiento
     */
    public function setIdTipoAccionBitacora($idTipoAccionBitacora)
    {
        $this->idTipoAccionBitacora = $idTipoAccionBitacora;

        return $this;
    }

    /**
     * Get idTipoAccionBitacora
     *
     * @return string
     */
    public function getIdTipoAccionBitacora()
    {
        return $this->idTipoAccionBitacora;
    }

    /**
     * Set tablaAfectada
     *
     * @param string $tablaAfectada
     * @return MntAuditoriaSeguimiento
     */
    public function setTablaAfectada($tablaAfectada)
    {
        $this->tablaAfectada = $tablaAfectada;

        return $this;
    }

    /**
     * Get tablaAfectada
     *
     * @return string
     */
    public function getTablaAfectada()
    {
        return $this->tablaAfectada;
    }

    /**
     * Set idRegistroAfectado
     *
     * @param integer $idRegistroAfectado
     * @return MntAuditoriaSeguimiento
     */
    public function setIdRegistroAfectado($idRegistroAfectado)
    {
        $this->idRegistroAfectado = $idRegistroAfectado;

        return $this;
    }

    /**
     * Get idRegistroAfectado
     *
     * @return integer
     */
    public function getIdRegistroAfectado()
    {
        return $this->idRegistroAfectado;
    }

    /**
     * Set camposAfectados
     *
     * @param string $camposAfectados
     * @return MntAuditoriaSeguimiento
     */
    public function setCamposAfectados($camposAfectados)
    {
        $this->camposAfectados = $camposAfectados;

        return $this;
    }

    /**
     * Get camposAfectados
     *
     * @return string
     */
    public function getCamposAfectados()
    {
        return $this->camposAfectados;
    }

    /**
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return MntAuditoriaSeguimiento
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
     * Set idUsuario
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuario
     * @return MntAuditoriaSeguimiento
     */
    public function setIdUsuario(\Application\Sonata\UserBundle\Entity\User $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
