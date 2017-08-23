<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * CtlRangoEdad
 *
 * @ORM\Table(name="ctl_rango_edad")
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, errorPath="nombre", message="El Nombre ya existe. No pueden existir Rangos de Edad con nombres similares.")
 */
class CtlRangoEdad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_rango_edad_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_minima_anios", type="integer", nullable=false)
     */
    private $edadMinimaAnios = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_minima_meses", type="integer", nullable=false)
     */
    private $edadMinimaMeses = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_minima_dias", type="integer", nullable=false)
     */
    private $edadMinimaDias = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_minima_horas", type="integer", nullable=false)
     */
    private $edadMinimaHoras = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_minima_minutos", type="integer", nullable=false)
     */
    private $edadMinimaMinutos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_maxima_anios", type="integer", nullable=false)
     */
    private $edadMaximaAnios = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_maxima_meses", type="integer", nullable=false)
     */
    private $edadMaximaMeses = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_maxima_dias", type="integer", nullable=false)
     */
    private $edadMaximaDias = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_maxima_horas", type="integer", nullable=false)
     */
    private $edadMaximaHoras = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_maxima_minutos", type="integer", nullable=false)
     */
    private $edadMaximaMinutos = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="cod_modulo", type="string", length=3, nullable=true)
     */
    private $codModulo;





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
     * Set nombre
     *
     * @param string $nombre
     * @return CtlRangoEdad
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
     * Set edadMinimaAnios
     *
     * @param integer $edadMinimaAnios
     * @return CtlRangoEdad
     */
    public function setEdadMinimaAnios($edadMinimaAnios)
    {
        $this->edadMinimaAnios = $edadMinimaAnios;

        return $this;
    }

    /**
     * Get edadMinimaAnios
     *
     * @return integer 
     */
    public function getEdadMinimaAnios()
    {
        return $this->edadMinimaAnios;
    }

    /**
     * Set edadMinimaMeses
     *
     * @param integer $edadMinimaMeses
     * @return CtlRangoEdad
     */
    public function setEdadMinimaMeses($edadMinimaMeses)
    {
        $this->edadMinimaMeses = $edadMinimaMeses;

        return $this;
    }

    /**
     * Get edadMinimaMeses
     *
     * @return integer 
     */
    public function getEdadMinimaMeses()
    {
        return $this->edadMinimaMeses;
    }

    /**
     * Set edadMinimaDias
     *
     * @param integer $edadMinimaDias
     * @return CtlRangoEdad
     */
    public function setEdadMinimaDias($edadMinimaDias)
    {
        $this->edadMinimaDias = $edadMinimaDias;

        return $this;
    }

    /**
     * Get edadMinimaDias
     *
     * @return integer 
     */
    public function getEdadMinimaDias()
    {
        return $this->edadMinimaDias;
    }

    /**
     * Set edadMinimaHoras
     *
     * @param integer $edadMinimaHoras
     * @return CtlRangoEdad
     */
    public function setEdadMinimaHoras($edadMinimaHoras)
    {
        $this->edadMinimaHoras = $edadMinimaHoras;

        return $this;
    }

    /**
     * Get edadMinimaHoras
     *
     * @return integer 
     */
    public function getEdadMinimaHoras()
    {
        return $this->edadMinimaHoras;
    }

    /**
     * Set edadMinimaMinutos
     *
     * @param integer $edadMinimaMinutos
     * @return CtlRangoEdad
     */
    public function setEdadMinimaMinutos($edadMinimaMinutos)
    {
        $this->edadMinimaMinutos = $edadMinimaMinutos;

        return $this;
    }

    /**
     * Get edadMinimaMinutos
     *
     * @return integer 
     */
    public function getEdadMinimaMinutos()
    {
        return $this->edadMinimaMinutos;
    }

    /**
     * Set edadMaximaAnios
     *
     * @param integer $edadMaximaAnios
     * @return CtlRangoEdad
     */
    public function setEdadMaximaAnios($edadMaximaAnios)
    {
        $this->edadMaximaAnios = $edadMaximaAnios;

        return $this;
    }

    /**
     * Get edadMaximaAnios
     *
     * @return integer 
     */
    public function getEdadMaximaAnios()
    {
        return $this->edadMaximaAnios;
    }

    /**
     * Set edadMaximaMeses
     *
     * @param integer $edadMaximaMeses
     * @return CtlRangoEdad
     */
    public function setEdadMaximaMeses($edadMaximaMeses)
    {
        $this->edadMaximaMeses = $edadMaximaMeses;

        return $this;
    }

    /**
     * Get edadMaximaMeses
     *
     * @return integer 
     */
    public function getEdadMaximaMeses()
    {
        return $this->edadMaximaMeses;
    }

    /**
     * Set edadMaximaDias
     *
     * @param integer $edadMaximaDias
     * @return CtlRangoEdad
     */
    public function setEdadMaximaDias($edadMaximaDias)
    {
        $this->edadMaximaDias = $edadMaximaDias;

        return $this;
    }

    /**
     * Get edadMaximaDias
     *
     * @return integer 
     */
    public function getEdadMaximaDias()
    {
        return $this->edadMaximaDias;
    }

    /**
     * Set edadMaximaHoras
     *
     * @param integer $edadMaximaHoras
     * @return CtlRangoEdad
     */
    public function setEdadMaximaHoras($edadMaximaHoras)
    {
        $this->edadMaximaHoras = $edadMaximaHoras;

        return $this;
    }

    /**
     * Get edadMaximaHoras
     *
     * @return integer 
     */
    public function getEdadMaximaHoras()
    {
        return $this->edadMaximaHoras;
    }

    /**
     * Set edadMaximaMinutos
     *
     * @param integer $edadMaximaMinutos
     * @return CtlRangoEdad
     */
    public function setEdadMaximaMinutos($edadMaximaMinutos)
    {
        $this->edadMaximaMinutos = $edadMaximaMinutos;

        return $this;
    }

    /**
     * Get edadMaximaMinutos
     *
     * @return integer 
     */
    public function getEdadMaximaMinutos()
    {
        return $this->edadMaximaMinutos;
    }

    /**
     * Set codModulo
     *
     * @param string $codModulo
     * @return CtlRangoEdad
     */
    public function setCodModulo($codModulo)
    {
        $this->codModulo = $codModulo;

        return $this;
    }

    /**
     * Get codModulo
     *
     * @return string 
     */
    public function getCodModulo()
    {
        return $this->codModulo;
    }
}
