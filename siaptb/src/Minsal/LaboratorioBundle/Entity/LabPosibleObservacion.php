<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabPosibleObservacion
 *
 * @ORM\Table(name="lab_posible_observacion")
 * @ORM\Entity
 */
class LabPosibleObservacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_posible_observacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="posible_observacion", type="string", length=500, nullable=false)
     */
    private $posibleObservacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=false)
     */
    private $habilitado = true;



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
     * Set posibleObservacion
     *
     * @param string $posibleObservacion
     * @return LabPosibleObservacion
     */
    public function setPosibleObservacion($posibleObservacion)
    {
        $this->posibleObservacion = $posibleObservacion;

        return $this;
    }

    /**
     * Get posibleObservacion
     *
     * @return string
     */
    public function getPosibleObservacion()
    {
        return $this->posibleObservacion;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return LabPosibleObservacion
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

    public function __toString()
    {
        return $this->posibleObservacion;
    }
}
