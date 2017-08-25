<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * CtlTipoObjeto
 *
 * @ORM\Table(name="ctl_tipo_objeto")
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, errorPath="nombre", message="El Nombre ya existe. No pueden existir Tipos con nombres similares.")
 */
class CtlTipoObjeto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_tipo_objeto_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="text", nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="aplica_para", type="integer", nullable=false)
     */
    private $aplicaPara;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;


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
     * @return CtlTipoObjeto
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
     * Set codigo
     *
     * @param string $codigo
     * @return CtlTipoObjeto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set aplicaPara
     *
     * @param integer $aplicaPara
     * @return CtlTipoObjeto
     */
    public function setAplicaPara($aplicaPara)
    {
        $this->aplicaPara = $aplicaPara;

        return $this;
    }

    /**
     * Get aplicaPara
     *
     * @return integer 
     */
    public function getAplicaPara()
    {
        return $this->aplicaPara;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlTipoObjeto
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


    public function __toString() 
    {
        return $this->nombre ?: ' ';
    }

    public function getApplyTo() 
    {
        if($this->aplicaPara==1)
            return '1 - Respuestas Tipo Catálogo (Lista de Opciones)';
        else
        if($this->aplicaPara==2)
            return '2 - Respuestas Tipo Campo (Casillas de Texto)';
        else
        if($this->aplicaPara==3)
            return '3 - Ambos (Respuestas Tipo Catálogo y Campo)';
        else
            return 'Error!';
    }

}
