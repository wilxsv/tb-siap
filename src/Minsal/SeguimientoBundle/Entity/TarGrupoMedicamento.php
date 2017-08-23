<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarGrupoMedicamento
 *
 * @ORM\Table(name="tar_grupo_medicamento")
 * @ORM\Entity
 */
class TarGrupoMedicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_grupo_medicamento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_grupo", type="string", length=100, nullable=false)
     */
    private $nomGrupo;



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
     * Set nomGrupo
     *
     * @param string $nomGrupo
     * @return TarGrupoMedicamento
     */
    public function setNomGrupo($nomGrupo)
    {
        $this->nomGrupo = $nomGrupo;

        return $this;
    }

    /**
     * Get nomGrupo
     *
     * @return string 
     */
    public function getNomGrupo()
    {
        return $this->nomGrupo;
    }
    
    public function __toString() {
        return (string) $this->nomGrupo? : '';
    }
}
