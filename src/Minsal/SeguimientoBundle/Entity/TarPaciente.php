<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarPaciente
 *
 * @ORM\Table(name="tar_paciente", indexes={@ORM\Index(name="IDX_317D9829961045CB", columns={"id_paciente"})})
 * @ORM\Entity
 */
class TarPaciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_paciente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sumeve", type="integer", nullable=true)
     */
    private $idSumeve;

    /**
     * @var integer
     *
     * @ORM\Column(name="idx", type="integer", nullable=true)
     */
    private $idx;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_idx", type="date", nullable=true)
     */
    private $fechaIdx;

    /**
     * @var \Minsal\SiapsBundle\MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;



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
     * Set idSumeve
     *
     * @param integer $idSumeve
     * @return TarPaciente
     */
    public function setIdSumeve($idSumeve)
    {
        $this->idSumeve = $idSumeve;

        return $this;
    }

    /**
     * Get idSumeve
     *
     * @return integer 
     */
    public function getIdSumeve()
    {
        return $this->idSumeve;
    }

    /**
     * Set idx
     *
     * @param integer $idx
     * @return TarPaciente
     */
    public function setIdx($idx)
    {
        $this->idx = $idx;

        return $this;
    }

    /**
     * Get idx
     *
     * @return integer 
     */
    public function getIdx()
    {
        return $this->idx;
    }

    /**
     * Set fechaIdx
     *
     * @param \DateTime $fechaIdx
     * @return TarPaciente
     */
    public function setFechaIdx($fechaIdx)
    {
        $this->fechaIdx = $fechaIdx;

        return $this;
    }

    /**
     * Get fechaIdx
     *
     * @return \DateTime 
     */
    public function getFechaIdx()
    {
        return $this->fechaIdx;
    }

    /**
     * Set idPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\MntPaciente $idPaciente
     * @return TarPaciente
     */
    public function setIdPaciente(\Minsal\SiapsBundle\Entity\MntPaciente $idPaciente = null)
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    /**
     * Get idPaciente
     *
     * @return \Minsal\SiapsBundle\Entity\MntPaciente 
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }
}
