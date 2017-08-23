<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrmFormItemPool
 *
 * @ORM\Table(name="frm_form_item_pool", indexes={@ORM\Index(name="IDX_132426EBC14F1F47", columns={"id_seccion_pool"}), @ORM\Index(name="IDX_132426EBB0F9D2E", columns={"id_form_item"}), @ORM\Index(name="IDX_132426EB3DE02BDB", columns={"id_padre"}), @ORM\Index(name="IDX_132426EBC14F1F40", columns={"validacion_padre"})})
 * @ORM\Entity
 */
class FrmFormItemPool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_form_item_pool_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_padre", type="text", nullable=true)
     */
    private $valorPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var \FrmSeccionPool
     *
     * @ORM\ManyToOne(targetEntity="FrmSeccionPool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_seccion_pool", referencedColumnName="id")
     * })
     */
    private $idSeccionPool;

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
     * @var \FrmFormItemPool
     *
     * @ORM\ManyToOne(targetEntity="FrmFormItemPool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_padre", referencedColumnName="id")
     * })
     */
    private $idPadre;

    /**
     * @var \CtlValidacionCampo
     *
     * @ORM\ManyToOne(targetEntity="CtlValidacionCampo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="validacion_padre", referencedColumnName="id")
     * })
     */
    private $validacionPadre;



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
     * Set valorPadre
     *
     * @param string $valorPadre
     * @return FrmFormItemPool
     */
    public function setValorPadre($valorPadre)
    {
        $this->valorPadre = $valorPadre;

        return $this;
    }

    /**
     * Get valorPadre
     *
     * @return string 
     */
    public function getValorPadre()
    {
        return $this->valorPadre;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return FrmFormItemPool
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set idSeccionPool
     *
     * @param \Application\CoreBundle\Entity\FrmSeccionPool $idSeccionPool
     * @return FrmFormItemPool
     */
    public function setIdSeccionPool(\Application\CoreBundle\Entity\FrmSeccionPool $idSeccionPool = null)
    {
        $this->idSeccionPool = $idSeccionPool;

        return $this;
    }

    /**
     * Get idSeccionPool
     *
     * @return \Application\CoreBundle\Entity\FrmSeccionPool 
     */
    public function getIdSeccionPool()
    {
        return $this->idSeccionPool;
    }

    /**
     * Set idFormItem
     *
     * @param \Application\CoreBundle\Entity\FrmFormItem $idFormItem
     * @return FrmFormItemPool
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
     * Set idPadre
     *
     * @param \Application\CoreBundle\Entity\FrmFormItemPool $idPadre
     * @return FrmFormItemPool
     */
    public function setIdPadre(\Application\CoreBundle\Entity\FrmFormItemPool $idPadre = null)
    {
        $this->idPadre = $idPadre;

        return $this;
    }

    /**
     * Get idPadre
     *
     * @return \Application\CoreBundle\Entity\FrmFormItemPool 
     */
    public function getIdPadre()
    {
        return $this->idPadre;
    }

    /**
     * Set validacionPadre
     *
     * @param \Application\CoreBundle\Entity\CtlValidacionCampo $validacionPadre
     * @return CtlValidacionCampo
     */
    public function setValidacionPadre(\Application\CoreBundle\Entity\CtlValidacionCampo $validacionPadre = null)
    {
        $this->validacionPadre = $validacionPadre;

        return $this;
    }

    /**
     * Get validacionPadre
     *
     * @return \Application\CoreBundle\Entity\CtlValidacionCampo 
     */
    public function getValidacionPadre()
    {
        return $this->validacionPadre;
    }
    

    public function __toString() 
    {
        return $this->idFormItem ?: ' ';
    }
}
