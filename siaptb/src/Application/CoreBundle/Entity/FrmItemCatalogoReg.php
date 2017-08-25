<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmItemCatalogoReg
 *
 * @ORM\Table(name="frm_item_catalogo_reg", indexes={@ORM\Index(name="IDX_13C81480AB55561E", columns={"id_form_item_catalogo"})})
 * @ORM\Entity
 */
class FrmItemCatalogoReg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_item_catalogo_reg_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_registro", type="integer", nullable=false)
     */
    private $idRegistro;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indica_alerta", type="boolean", nullable=false)
     */
    private $indicaAlerta = false;

    /**
     * @var \FrmFormItemCatalogo
     *
     * @ORM\ManyToOne(targetEntity="FrmFormItemCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_form_item_catalogo", referencedColumnName="id")
     * })
     */
    private $idFormItemCatalogo;



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
     * Set idRegistro
     *
     * @param integer $idRegistro
     * @return FrmItemCatalogoReg
     */
    public function setIdRegistro($idRegistro)
    {
        $this->idRegistro = $idRegistro;

        return $this;
    }

    /**
     * Get idRegistro
     *
     * @return integer 
     */
    public function getIdRegistro()
    {
        return $this->idRegistro;
    }

    /**
     * Set indicaAlerta
     *
     * @param boolean $indicaAlerta
     * @return FrmItemCatalogoReg
     */
    public function setIndicaAlerta($indicaAlerta)
    {
        $this->indicaAlerta = $indicaAlerta;

        return $this;
    }

    /**
     * Get indicaAlerta
     *
     * @return boolean 
     */
    public function getIndicaAlerta()
    {
        return $this->indicaAlerta;
    }

    /**
     * Set idFormItemCatalogo
     *
     * @param \Application\CoreBundle\Entity\FrmFormItemCatalogo $idFormItemCatalogo
     * @return FrmItemCatalogoReg
     */
    public function setIdFormItemCatalogo(\Application\CoreBundle\Entity\FrmFormItemCatalogo $idFormItemCatalogo = null)
    {
        $this->idFormItemCatalogo = $idFormItemCatalogo;

        return $this;
    }

    /**
     * Get idFormItemCatalogo
     *
     * @return \Application\CoreBundle\Entity\FrmFormItemCatalogo 
     */
    public function getIdFormItemCatalogo()
    {
        return $this->idFormItemCatalogo;
    }
}
