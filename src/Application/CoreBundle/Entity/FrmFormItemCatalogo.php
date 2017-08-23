<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmFormItemCatalogo
 *
 * @ORM\Table(name="frm_form_item_catalogo", indexes={@ORM\Index(name="IDX_9FECBD7CB0F9D2E", columns={"id_form_item"}), @ORM\Index(name="IDX_9FECBD7CB77787D0", columns={"id_catalogo"})})
 * @ORM\Entity
 */
class FrmFormItemCatalogo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_form_item_catalogo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \FrmFormItem
     *
     * @ORM\ManyToOne(targetEntity="FrmFormItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_form_item", referencedColumnName="id")
     * })
     */
    private $idFormItem;

    /**
     * @var \CtlCatalogoFormulario
     *
     * @ORM\ManyToOne(targetEntity="CtlCatalogoFormulario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_catalogo", referencedColumnName="id")
     * })
     */
    private $idCatalogo;



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
     * Set idFormItem
     *
     * @param \Application\CoreBundle\Entity\FrmFormItem $idFormItem
     * @return FrmFormItemCatalogo
     */
    public function setIdFormItem(\Application\CoreBundle\Entity\FrmFormItem $idFormItem = null)
    {
        $this->idFormItem = $idFormItem;

        return $this;
    }

    /**
     * Get idFormItem
     *
     * @return \Application\CoreBundle\Entity\FrmFormItem 
     */
    public function getIdFormItem()
    {
        return $this->idFormItem;
    }

    /**
     * Set idCatalogo
     *
     * @param \Application\CoreBundle\Entity\CtlCatalogoFormulario $idCatalogo
     * @return FrmFormItemCatalogo
     */
    public function setIdCatalogo(\Application\CoreBundle\Entity\CtlCatalogoFormulario $idCatalogo = null)
    {
        $this->idCatalogo = $idCatalogo;

        return $this;
    }

    /**
     * Get idCatalogo
     *
     * @return \Application\CoreBundle\Entity\CtlCatalogoFormulario 
     */
    public function getIdCatalogo()
    {
        return $this->idCatalogo;
    }
}
