<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntRangohora
 *
 * @ORM\Table(name="mnt_rangohora", indexes={@ORM\Index(name="IDX_C8705FB7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_C8705FBCAC67ADB", columns={"id_modulo"}), @ORM\Index(name="IDX_C8705FB13B895A1", columns={"idusuarioreg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repositorio\MntRangohoraRepository")
 */
class MntRangohora
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_rangohora_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_ini", type="time", nullable=true)
     */
    private $horaIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=true)
     */
    private $horaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = true;

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
     * @var \CtlModulo
     *
     * @ORM\ManyToOne(targetEntity="CtlModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id")
     * })
     */
    private $idModulo;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set horaIni
     *
     * @param \DateTime $horaIni
     * @return MntRangohora
     */
    public function setHoraIni($horaIni)
    {
        $this->horaIni = $horaIni;

        return $this;
    }

    /**
     * Get horaIni
     *
     * @return \DateTime
     */
    public function getHoraIni()
    {
        return $this->horaIni;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     * @return MntRangohora
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return MntRangohora
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
     * Set activo
     *
     * @param boolean $activo
     * @return MntRangohora
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return MntRangohora
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
     * Set idModulo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlModulo $idModulo
     * @return MntRangohora
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return MntRangohora
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

    public function getFormatterHoraIni() {
        return $this->id ? $this->horaIni->format('h:i:s A') : '';
    }

    public function getFormatterHoraFin() {
        return $this->id ? $this->horaFin->format('h:i:s A') : '';
    }

    public function getFormatterRangHora() {
        return $this->id ? ( $this->horaIni->format('h:i:s A').' - '.$this->horaFin->format('h:i:s A') ) : '';
    }

    public function __toString() {
        return $this->id ? ( $this->horaIni->format('h:i:s A').' - '.$this->horaFin->format('h:i:s A') ) : '';
    }
}
