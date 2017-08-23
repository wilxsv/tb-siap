<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmValidacionCampoFormItem
 *
 * @ORM\Table(name="frm_validacion_campo_form_item", indexes={@ORM\Index(name="IDX_D98893C6B0F9D2E", columns={"id_form_item"}), @ORM\Index(name="IDX_D98893C6E7FCFDF9", columns={"id_validacion_campo"})})
 * @ORM\Entity
 */
class FrmValidacionCampoFormItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_validacion_campo_form_item_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_comparacion", type="text", nullable=true)
     */
    private $valorComparacion;

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
     * @return FrmValidacionCampoFormItem
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
     * Set idFormItem
     *
     * @param \Application\CoreBundle\Entity\FrmFormItem $idFormItem
     * @return FrmValidacionCampoFormItem
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
     * Set idValidacionCampo
     *
     * @param \Application\CoreBundle\Entity\CtlValidacionCampo $idValidacionCampo
     * @return FrmValidacionCampoFormItem
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
