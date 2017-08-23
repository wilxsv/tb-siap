<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * CtlTabla
 *
 * @ORM\Table(name="ctl_tabla")
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, errorPath="nombre", message="La Tabla que esta creando ya existe.")
 */
class CtlTabla
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_tabla_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_tabla", type="integer", nullable=false)
     */
    private $tipoTabla;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_transaccion", type="integer", nullable=false)
     */
    private $tipoTransaccion;



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
     * @return CtlTabla
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlTabla
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
     * Set tipoTabla
     *
     * @param integer $tipoTabla
     * @return CtlTabla
     */
    public function setTipoTabla($tipoTabla)
    {
        $this->tipoTabla = $tipoTabla;

        return $this;
    }

    /**
     * Get tipoTabla
     *
     * @return integer 
     */
    public function getTipoTabla()
    {
        return $this->tipoTabla;
    }

    /**
     * Set tipoTransaccion
     *
     * @param integer $tipoTransaccion
     * @return CtlTabla
     */
    public function setTipoTransaccion($tipoTransaccion)
    {
        $this->tipoTransaccion = $tipoTransaccion;

        return $this;
    }

    /**
     * Get tipoTransaccion
     *
     * @return integer 
     */
    public function getTipoTransaccion()
    {
        return $this->tipoTransaccion;
    }


    public function __toString() 
    {
        return $this->nombre ?: ' ';
    }

}
