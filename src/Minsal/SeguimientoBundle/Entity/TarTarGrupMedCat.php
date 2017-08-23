<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarTarGrupMedCat
 *
 * @ORM\Table(name="tar_tar_grup_med_cat", indexes={@ORM\Index(name="IDX_1D0E10FFB7295AC5", columns={"id_grup_med"}), @ORM\Index(name="IDX_1D0E10FFD18B1B73", columns={"id_medicamento"})})
 * @ORM\Entity
 */
class TarTarGrupMedCat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_tar_grup_med_cat_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \TarGrupoMedicamento
     *
     * @ORM\ManyToOne(targetEntity="TarGrupoMedicamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grup_med", referencedColumnName="id")
     * })
     */
    private $idGrupMed;

   /**
     * @var integer
     *
     * @ORM\Column(name="descripcion", type="integer", nullable=false)
     */
    private $idMedicamento;



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
     * Set idGrupMed
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarGrupoMedicamento $idGrupMed
     * @return TarTarGrupMedCat
     */
    public function setIdGrupMed(\Minsal\SeguimientoBundle\Entity\TarGrupoMedicamento $idGrupMed = null)
    {
        $this->idGrupMed = $idGrupMed;

        return $this;
    }

    /**
     * Get idGrupMed
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarGrupoMedicamento 
     */
    public function getIdGrupMed()
    {
        return $this->idGrupMed;
    }

    /**
     * Set idMedicamento
     *
     * @param integer $idMedicamento
     * @return TarTarGrupMedCat
     */
    public function setIdMedicamento( $idMedicamento = null)
    {
        $this->idMedicamento = $idMedicamento;

        return $this;
    }

    /**
     * Get idMedicamento
     *
     * @return integer
     */
    public function getIdMedicamento()
    {
        return $this->idMedicamento;
    }
}
