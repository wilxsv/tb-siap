<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FarmRangohora
 *
 * @ORM\Table(name="farm_rangohora")
 * @ORM\Entity
 */
class FarmRangohora
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="farm_rangohora_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_ini", type="time", nullable=false)
     */
    private $horaIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=false)
     */
    private $horaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="modulo", type="string", length=60, nullable=false)
     */
    private $modulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="limite", type="integer", nullable=true)
     */
    private $limite;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuarioreg", type="integer", nullable=false)
     */
    private $idusuarioreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=false)
     */
    private $fechahorareg;

    /**
     * @var string
     *
     * @ORM\Column(name="meridianoini", type="string", nullable=false)
     */
    private $meridianoini;

    /**
     * @var string
     *
     * @ORM\Column(name="meridianofin", type="string", nullable=false)
     */
    private $meridianofin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_establecimiento", type="integer", nullable=false)
     */
    private $idEstablecimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="limitedeldia", type="integer", nullable=true)
     */
    private $limitedeldia;

    /**
     * @var integer
     *
     * @ORM\Column(name="limiterepetitiva", type="integer", nullable=true)
     */
    private $limiterepetitiva;



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
     * @return FarmRangohora
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
     * @return FarmRangohora
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
     * Set modulo
     *
     * @param string $modulo
     * @return FarmRangohora
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;

        return $this;
    }

    /**
     * Get modulo
     *
     * @return string
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set limite
     *
     * @param integer $limite
     * @return FarmRangohora
     */
    public function setLimite($limite)
    {
        $this->limite = $limite;

        return $this;
    }

    /**
     * Get limite
     *
     * @return integer
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * Set idusuarioreg
     *
     * @param integer $idusuarioreg
     * @return FarmRangohora
     */
    public function setIdusuarioreg($idusuarioreg)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return integer
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return FarmRangohora
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
     * Set meridianoini
     *
     * @param string $meridianoini
     * @return FarmRangohora
     */
    public function setMeridianoini($meridianoini)
    {
        $this->meridianoini = $meridianoini;

        return $this;
    }

    /**
     * Get meridianoini
     *
     * @return string
     */
    public function getMeridianoini()
    {
        return $this->meridianoini;
    }

    /**
     * Set meridianofin
     *
     * @param string $meridianofin
     * @return FarmRangohora
     */
    public function setMeridianofin($meridianofin)
    {
        $this->meridianofin = $meridianofin;

        return $this;
    }

    /**
     * Get meridianofin
     *
     * @return string
     */
    public function getMeridianofin()
    {
        return $this->meridianofin;
    }

    /**
     * Set idEstablecimiento
     *
     * @param integer $idEstablecimiento
     * @return FarmRangohora
     */
    public function setIdEstablecimiento($idEstablecimiento)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return integer
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set limitedeldia
     *
     * @param integer $limitedeldia
     * @return FarmRangohora
     */
    public function setLimitedeldia($limitedeldia)
    {
        $this->limitedeldia = $limitedeldia;

        return $this;
    }

    /**
     * Get limitedeldia
     *
     * @return integer
     */
    public function getLimitedeldia()
    {
        return $this->limitedeldia;
    }

    /**
     * Set limiterepetitiva
     *
     * @param integer $limiterepetitiva
     * @return FarmRangohora
     */
    public function setLimiterepetitiva($limiterepetitiva)
    {
        $this->limiterepetitiva = $limiterepetitiva;

        return $this;
    }

    /**
     * Get limiterepetitiva
     *
     * @return integer
     */
    public function getLimiterepetitiva()
    {
        return $this->limiterepetitiva;
    }

    public function __toString() {
        return ($this->horaIni->format('H:i')).' '.$this->meridianoini.' - '.($this->horaFin->format('H:i')).' '.$this->meridianofin;
    }
}
