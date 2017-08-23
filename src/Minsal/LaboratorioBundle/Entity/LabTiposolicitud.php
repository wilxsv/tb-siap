<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabTiposolicitud
 *
 * @ORM\Table(name="lab_tiposolicitud")
 * @ORM\Entity
 */
class LabTiposolicitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_tiposolicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idtiposolicitud", type="string", length=1, nullable=false)
     */
    private $idtiposolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="tiposolicitud", type="string", length=25, nullable=true)
     */
    private $tiposolicitud;



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
     * Set idtiposolicitud
     *
     * @param string $idtiposolicitud
     * @return LabTiposolicitud
     */
    public function setIdtiposolicitud($idtiposolicitud)
    {
        $this->idtiposolicitud = $idtiposolicitud;

        return $this;
    }

    /**
     * Get idtiposolicitud
     *
     * @return string 
     */
    public function getIdtiposolicitud()
    {
        return $this->idtiposolicitud;
    }

    /**
     * Set tiposolicitud
     *
     * @param string $tiposolicitud
     * @return LabTiposolicitud
     */
    public function setTiposolicitud($tiposolicitud)
    {
        $this->tiposolicitud = $tiposolicitud;

        return $this;
    }

    /**
     * Get tiposolicitud
     *
     * @return string 
     */
    public function getTiposolicitud()
    {
        return $this->tiposolicitud;
    }
}
