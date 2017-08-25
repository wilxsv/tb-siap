<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmInsercionOmision
 *
 * @ORM\Table(name="frm_insercion_omision", indexes={@ORM\Index(name="IDX_46C634D82BC7EF77", columns={"id_form_item_pool"}), @ORM\Index(name="IDX_46C634D8F1E1FDD5", columns={"id_grupo_insercion"}), @ORM\Index(name="IDX_46C634D8E7FCFDF9", columns={"id_validacion_campo"})})
 * @ORM\Entity
 */
class FrmInsercionOmision
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_insercion_omision_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_comparacion", type="text", nullable=true)
     */
    private $valorComparacion;

    /**
     * @var \FrmFormItemPool
     *
     * @ORM\ManyToOne(targetEntity="FrmFormItemPool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_form_item_pool", referencedColumnName="id")
     * })
     */
    private $idFormItemPool;

    /**
     * @var \FrmGrupoInsercion
     *
     * @ORM\ManyToOne(targetEntity="FrmGrupoInsercion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_insercion", referencedColumnName="id")
     * })
     */
    private $idGrupoInsercion;

    /**
     * @var \CtlValidacionCampo
     *
     * @ORM\ManyToOne(targetEntity="CtlValidacionCampo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_validacion_campo", referencedColumnName="id")
     * })
     */
    private $idValidacionCampo;



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
     * Set valorComparacion
     *
     * @param string $valorComparacion
     * @return FrmInsercionOmision
     */
    public function setValorComparacion($valorComparacion)
    {
        $this->valorComparacion = $valorComparacion;

        return $this;
    }

    /**
     * Get valorComparacion
     *
     * @return string 
     */
    public function getValorComparacion()
    {
        return $this->valorComparacion;
    }

    /**
     * Set idFormItemPool
     *
     * @param \Application\CoreBundle\Entity\FrmFormItemPool $idFormItemPool
     * @return FrmInsercionOmision
     */
    public function setIdFormItemPool(\Application\CoreBundle\Entity\FrmFormItemPool $idFormItemPool = null)
    {
        $this->idFormItemPool = $idFormItemPool;

        return $this;
    }

    /**
     * Get idFormItemPool
     *
     * @return \Application\CoreBundle\Entity\FrmFormItemPool 
     */
    public function getIdFormItemPool()
    {
        return $this->idFormItemPool;
    }

    /**
     * Set idGrupoInsercion
     *
     * @param \Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercion
     * @return FrmInsercionOmision
     */
    public function setIdGrupoInsercion(\Application\CoreBundle\Entity\FrmGrupoInsercion $idGrupoInsercion = null)
    {
        $this->idGrupoInsercion = $idGrupoInsercion;

        return $this;
    }

    /**
     * Get idGrupoInsercion
     *
     * @return \Application\CoreBundle\Entity\FrmGrupoInsercion 
     */
    public function getIdGrupoInsercion()
    {
        return $this->idGrupoInsercion;
    }

    /**
     * Set idValidacionCampo
     *
     * @param \Application\CoreBundle\Entity\CtlValidacionCampo $idValidacionCampo
     * @return FrmInsercionOmision
     */
    public function setIdValidacionCampo(\Application\CoreBundle\Entity\CtlValidacionCampo $idValidacionCampo = null)
    {
        $this->idValidacionCampo = $idValidacionCampo;

        return $this;
    }

    /**
     * Get idValidacionCampo
     *
     * @return \Application\CoreBundle\Entity\CtlValidacionCampo 
     */
    public function getIdValidacionCampo()
    {
        return $this->idValidacionCampo;
    }
}
