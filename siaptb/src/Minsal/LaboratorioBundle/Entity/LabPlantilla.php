<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabPlantilla
 *
 * @ORM\Table(name="lab_plantilla")
 * @ORM\Entity
 */
class LabPlantilla
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_plantilla_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idplantilla", type="string", nullable=false)
     */
    private $idplantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="plantilla", type="string", length=30, nullable=true)
     */
    private $plantilla;



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
     * Set idplantilla
     *
     * @param string $idplantilla
     * @return LabPlantilla
     */
    public function setIdplantilla($idplantilla)
    {
        $this->idplantilla = $idplantilla;

        return $this;
    }

    /**
     * Get idplantilla
     *
     * @return string 
     */
    public function getIdplantilla()
    {
        return $this->idplantilla;
    }

    /**
     * Set plantilla
     *
     * @param string $plantilla
     * @return LabPlantilla
     */
    public function setPlantilla($plantilla)
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    /**
     * Get plantilla
     *
     * @return string 
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }
}
