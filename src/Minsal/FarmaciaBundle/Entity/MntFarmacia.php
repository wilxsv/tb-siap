<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntFarmacia
 *
 * @ORM\Table(name="mnt_farmacia")
 * @ORM\Entity
 */
class MntFarmacia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_farmacia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="farmacia", type="string", length=50, nullable=false)
     */
    private $farmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitadofarmacia", type="string", nullable=false)
     */
    private $habilitadofarmacia = 'S';



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
     * Set farmacia
     *
     * @param string $farmacia
     * @return MntFarmacia
     */
    public function setFarmacia($farmacia)
    {
        $this->farmacia = $farmacia;

        return $this;
    }

    /**
     * Get farmacia
     *
     * @return string 
     */
    public function getFarmacia()
    {
        return $this->farmacia;
    }

    /**
     * Set habilitadofarmacia
     *
     * @param string $habilitadofarmacia
     * @return MntFarmacia
     */
    public function setHabilitadofarmacia($habilitadofarmacia)
    {
        $this->habilitadofarmacia = $habilitadofarmacia;

        return $this;
    }

    /**
     * Get habilitadofarmacia
     *
     * @return string 
     */
    public function getHabilitadofarmacia()
    {
        return $this->habilitadofarmacia;
    }
    
     
    public function __toString() {
        return $this->farmacia ? $this->farmacia : '';
    }
}
