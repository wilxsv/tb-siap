<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitTipoDistribucion
 *
 * @ORM\Table(name="cit_tipo_distribucion", indexes={@ORM\Index(name="IDX_6E46E176D58F2214", columns={"id_usuario_registra"}), @ORM\Index(name="IDX_6E46E176721098ED", columns={"id_usuario_modifica"})})
 * @ORM\Entity
 */
class CitTipoDistribucion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_tipo_distribucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registra", type="datetime", nullable=false)
     */
    private $fechaHoraRegistra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_modifica", type="datetime", nullable=true)
     */
    private $fechaHoraModifica;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_registra", referencedColumnName="id")
     * })
     */
    private $idUsuarioRegistra;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_modifica", referencedColumnName="id")
     * })
     */
    private $idUsuarioModifica;

    /**
     * @var boolean
     *
     * @ORM\Column(name="permite_mas_citas", type="boolean", nullable=true)
     */
    private $permiteMasCitas=false;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CitTipoDistribucion
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CitTipoDistribucion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set fechaHoraRegistra
     *
     * @param \DateTime $fechaHoraRegistra
     * @return CitTipoDistribucion
     */
    public function setFechaHoraRegistra($fechaHoraRegistra) {
        $this->fechaHoraRegistra = $fechaHoraRegistra;

        return $this;
    }

    /**
     * Get fechaHoraRegistra
     *
     * @return \DateTime
     */
    public function getFechaHoraRegistra() {
        return $this->fechaHoraRegistra;
    }

    /**
     * Set fechaHoraModifica
     *
     * @param \DateTime $fechaHoraModifica
     * @return CitTipoDistribucion
     */
    public function setFechaHoraModifica($fechaHoraModifica) {
        $this->fechaHoraModifica = $fechaHoraModifica;

        return $this;
    }

    /**
     * Get fechaHoraModifica
     *
     * @return \DateTime
     */
    public function getFechaHoraModifica() {
        return $this->fechaHoraModifica;
    }

    /**
     * Set idUsuarioRegistra
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioRegistra
     * @return CitTipoDistribucion
     */
    public function setIdUsuarioRegistra(\Application\Sonata\UserBundle\Entity\User $idUsuarioRegistra = null) {
        $this->idUsuarioRegistra = $idUsuarioRegistra;

        return $this;
    }

    /**
     * Get idUsuarioRegistra
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUsuarioRegistra() {
        return $this->idUsuarioRegistra;
    }

    /**
     * Set idUsuarioModifica
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioModifica
     * @return CitTipoDistribucion
     */
    public function setIdUsuarioModifica(\Application\Sonata\UserBundle\Entity\User $idUsuarioModifica = null) {
        $this->idUsuarioModifica = $idUsuarioModifica;

        return $this;
    }

    /**
     * Get idUsuarioModifica
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUsuarioModifica() {
        return $this->idUsuarioModifica;
    }

    public function __toString() {
        return $this->nombre? : '';
    }


    /**
     * Set permiteMasCitas
     *
     * @param boolean $permiteMasCitas
     * @return CitTipoDistribucion
     */
    public function setPermiteMasCitas($permiteMasCitas)
    {
        $this->permiteMasCitas = $permiteMasCitas;

        return $this;
    }

    /**
     * Get permiteMasCitas
     *
     * @return boolean 
     */
    public function getPermiteMasCitas()
    {
        return $this->permiteMasCitas;
    }
}
