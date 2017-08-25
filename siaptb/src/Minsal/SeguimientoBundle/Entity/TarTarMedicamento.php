<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarTarMedicamento
 *
 * @ORM\Table(name="tar_tar_medicamento", indexes={@ORM\Index(name="IDX_1EA750AAB7295AC5", columns={"id_grup_med"}), @ORM\Index(name="IDX_1EA750AA1AA1BA42", columns={"id_sec_tar"})})
 * @ORM\Entity
 */
class TarTarMedicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_tar_medicamento_id_seq", allocationSize=1, initialValue=1)
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
     * @var \TarSecTar
     *
     * @ORM\ManyToOne(targetEntity="TarSecTar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sec_tar", referencedColumnName="id")
     * })
     */
    private $idSecTar;



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
     * @return TarTarMedicamento
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
     * Set idSecTar
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarSecTar $idSecTar
     * @return TarTarMedicamento
     */
    public function setIdSecTar(\Minsal\SeguimientoBundle\Entity\TarSecTar $idSecTar = null)
    {
        $this->idSecTar = $idSecTar;

        return $this;
    }

    /**
     * Get idSecTar
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarSecTar 
     */
    public function getIdSecTar()
    {
        return $this->idSecTar;
    }
}
