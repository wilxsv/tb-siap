<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabPosibleResultado
 *
 * @ORM\Table(name="lab_posible_resultado", indexes={@ORM\Index(name="IDX_3D5FF0AAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_3D5FF0A6B3CA4B", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="Minsal\LaboratorioBundle\Repositorio\LabPosibleResultadoRepository")
 */
class LabPosibleResultado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_posible_resultado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="posible_resultado", type="string", length=250, nullable=false)
     */
    private $posibleResultado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechainicio", type="datetime", nullable=false)
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafin", type="datetime", nullable=true)
     */
    private $fechafin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mod", type="datetime", nullable=true)
     */
    private $fechaMod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;



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
     * Set posibleResultado
     *
     * @param string $posibleResultado
     * @return LabPosibleResultado
     */
    public function setPosibleResultado($posibleResultado)
    {
        $this->posibleResultado = $posibleResultado;

        return $this;
    }

    /**
     * Get posibleResultado
     *
     * @return string
     */
    public function getPosibleResultado()
    {
        return $this->posibleResultado;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     * @return LabPosibleResultado
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin
     *
     * @param \DateTime $fechafin
     * @return LabPosibleResultado
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return \DateTime
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return LabPosibleResultado
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaMod
     *
     * @param \DateTime $fechaMod
     * @return LabPosibleResultado
     */
    public function setFechaMod($fechaMod)
    {
        $this->fechaMod = $fechaMod;

        return $this;
    }

    /**
     * Get fechaMod
     *
     * @return \DateTime
     */
    public function getFechaMod()
    {
        return $this->fechaMod;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return LabPosibleResultado
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return LabPosibleResultado
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
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return LabPosibleResultado
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idUser
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUser
     * @return LabPosibleResultado
     */
    public function setIdUser(\Application\Sonata\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
