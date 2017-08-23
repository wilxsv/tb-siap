<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabMetodologia
 *
 * @ORM\Table(name="lab_metodologia")
 * @ORM\Entity
 */
class LabMetodologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_metodologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_metodologia", type="string", length=200, nullable=false)
     */
    private $nombreMetodologia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activa", type="boolean", nullable=false)
     */
    private $activa = true;



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
     * Set nombreMetodologia
     *
     * @param string $nombreMetodologia
     * @return LabMetodologia
     */
    public function setNombreMetodologia($nombreMetodologia)
    {
        $this->nombreMetodologia = $nombreMetodologia;

        return $this;
    }

    /**
     * Get nombreMetodologia
     *
     * @return string 
     */
    public function getNombreMetodologia()
    {
        return $this->nombreMetodologia;
    }

    /**
     * Set activa
     *
     * @param boolean $activa
     * @return LabMetodologia
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get activa
     *
     * @return boolean 
     */
    public function getActiva()
    {
        return $this->activa;
    }
}
