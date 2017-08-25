<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntSnomedCie10
 *
 * @ORM\Table(name="mnt_snomed_cie10", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo", columns={"codigo"})}, indexes={@ORM\Index(name="idx_sct_name_es", columns={"sct_name_es"}), @ORM\Index(name="IDX_5E7C27F91E833DEC", columns={"id_cie10"})})
 * @ORM\Entity
 */
class MntSnomedCie10
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_snomed_cie10_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="effective_time", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $effectiveTime;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="module_id", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $moduleId;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_set_id", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $refSetId;

    /**
     * @var string
     *
     * @ORM\Column(name="referenced_component_id", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $referencedComponentId;

    /**
     * @var string
     *
     * @ORM\Column(name="sct_name", type="string", nullable=true)
     */
    private $sctName;

    /**
     * @var string
     *
     * @ORM\Column(name="sct_name_es", type="string", nullable=true)
     */
    private $sctNameEs;

    /**
     * @var string
     *
     * @ORM\Column(name="map_group", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $mapGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="map_priority", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $mapPriority;

    /**
     * @var string
     *
     * @ORM\Column(name="map_rule", type="string", nullable=true)
     */
    private $mapRule;

    /**
     * @var string
     *
     * @ORM\Column(name="map_advice", type="string", nullable=true)
     */
    private $mapAdvice;

    /**
     * @var string
     *
     * @ORM\Column(name="map_target", type="string", nullable=true)
     */
    private $mapTarget;

    /**
     * @var string
     *
     * @ORM\Column(name="icd_name", type="string", nullable=true)
     */
    private $icdName;

    /**
     * @var string
     *
     * @ORM\Column(name="icd_name_es", type="string", nullable=true)
     */
    private $icdNameEs;

    /**
     * @var string
     *
     * @ORM\Column(name="map_category_id", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $mapCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="map_category_value", type="string", nullable=true)
     */
    private $mapCategoryValue;

    /**
     * @var string
     *
     * @ORM\Column(name="unaccent_sct_name_es", type="text", nullable=true)
     */
    private $unaccentSctNameEs;

    /**
     * @var \MntCie10
     *
     * @ORM\ManyToOne(targetEntity="MntCie10")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cie10", referencedColumnName="id")
     * })
     */
    private $idCie10;



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
     * Set codigo
     *
     * @param string $codigo
     * @return MntSnomedCie10
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set effectiveTime
     *
     * @param string $effectiveTime
     * @return MntSnomedCie10
     */
    public function setEffectiveTime($effectiveTime)
    {
        $this->effectiveTime = $effectiveTime;

        return $this;
    }

    /**
     * Get effectiveTime
     *
     * @return string 
     */
    public function getEffectiveTime()
    {
        return $this->effectiveTime;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return MntSnomedCie10
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set moduleId
     *
     * @param string $moduleId
     * @return MntSnomedCie10
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return string 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set refSetId
     *
     * @param string $refSetId
     * @return MntSnomedCie10
     */
    public function setRefSetId($refSetId)
    {
        $this->refSetId = $refSetId;

        return $this;
    }

    /**
     * Get refSetId
     *
     * @return string 
     */
    public function getRefSetId()
    {
        return $this->refSetId;
    }

    /**
     * Set referencedComponentId
     *
     * @param string $referencedComponentId
     * @return MntSnomedCie10
     */
    public function setReferencedComponentId($referencedComponentId)
    {
        $this->referencedComponentId = $referencedComponentId;

        return $this;
    }

    /**
     * Get referencedComponentId
     *
     * @return string 
     */
    public function getReferencedComponentId()
    {
        return $this->referencedComponentId;
    }

    /**
     * Set sctName
     *
     * @param string $sctName
     * @return MntSnomedCie10
     */
    public function setSctName($sctName)
    {
        $this->sctName = $sctName;

        return $this;
    }

    /**
     * Get sctName
     *
     * @return string 
     */
    public function getSctName()
    {
        return $this->sctName;
    }

    /**
     * Set sctNameEs
     *
     * @param string $sctNameEs
     * @return MntSnomedCie10
     */
    public function setSctNameEs($sctNameEs)
    {
        $this->sctNameEs = $sctNameEs;

        return $this;
    }

    /**
     * Get sctNameEs
     *
     * @return string 
     */
    public function getSctNameEs()
    {
        return $this->sctNameEs;
    }

    /**
     * Set mapGroup
     *
     * @param string $mapGroup
     * @return MntSnomedCie10
     */
    public function setMapGroup($mapGroup)
    {
        $this->mapGroup = $mapGroup;

        return $this;
    }

    /**
     * Get mapGroup
     *
     * @return string 
     */
    public function getMapGroup()
    {
        return $this->mapGroup;
    }

    /**
     * Set mapPriority
     *
     * @param string $mapPriority
     * @return MntSnomedCie10
     */
    public function setMapPriority($mapPriority)
    {
        $this->mapPriority = $mapPriority;

        return $this;
    }

    /**
     * Get mapPriority
     *
     * @return string 
     */
    public function getMapPriority()
    {
        return $this->mapPriority;
    }

    /**
     * Set mapRule
     *
     * @param string $mapRule
     * @return MntSnomedCie10
     */
    public function setMapRule($mapRule)
    {
        $this->mapRule = $mapRule;

        return $this;
    }

    /**
     * Get mapRule
     *
     * @return string 
     */
    public function getMapRule()
    {
        return $this->mapRule;
    }

    /**
     * Set mapAdvice
     *
     * @param string $mapAdvice
     * @return MntSnomedCie10
     */
    public function setMapAdvice($mapAdvice)
    {
        $this->mapAdvice = $mapAdvice;

        return $this;
    }

    /**
     * Get mapAdvice
     *
     * @return string 
     */
    public function getMapAdvice()
    {
        return $this->mapAdvice;
    }

    /**
     * Set mapTarget
     *
     * @param string $mapTarget
     * @return MntSnomedCie10
     */
    public function setMapTarget($mapTarget)
    {
        $this->mapTarget = $mapTarget;

        return $this;
    }

    /**
     * Get mapTarget
     *
     * @return string 
     */
    public function getMapTarget()
    {
        return $this->mapTarget;
    }

    /**
     * Set icdName
     *
     * @param string $icdName
     * @return MntSnomedCie10
     */
    public function setIcdName($icdName)
    {
        $this->icdName = $icdName;

        return $this;
    }

    /**
     * Get icdName
     *
     * @return string 
     */
    public function getIcdName()
    {
        return $this->icdName;
    }

    /**
     * Set icdNameEs
     *
     * @param string $icdNameEs
     * @return MntSnomedCie10
     */
    public function setIcdNameEs($icdNameEs)
    {
        $this->icdNameEs = $icdNameEs;

        return $this;
    }

    /**
     * Get icdNameEs
     *
     * @return string 
     */
    public function getIcdNameEs()
    {
        return $this->icdNameEs;
    }

    /**
     * Set mapCategoryId
     *
     * @param string $mapCategoryId
     * @return MntSnomedCie10
     */
    public function setMapCategoryId($mapCategoryId)
    {
        $this->mapCategoryId = $mapCategoryId;

        return $this;
    }

    /**
     * Get mapCategoryId
     *
     * @return string 
     */
    public function getMapCategoryId()
    {
        return $this->mapCategoryId;
    }

    /**
     * Set mapCategoryValue
     *
     * @param string $mapCategoryValue
     * @return MntSnomedCie10
     */
    public function setMapCategoryValue($mapCategoryValue)
    {
        $this->mapCategoryValue = $mapCategoryValue;

        return $this;
    }

    /**
     * Get mapCategoryValue
     *
     * @return string 
     */
    public function getMapCategoryValue()
    {
        return $this->mapCategoryValue;
    }

    /**
     * Set unaccentSctNameEs
     *
     * @param string $unaccentSctNameEs
     * @return MntSnomedCie10
     */
    public function setUnaccentSctNameEs($unaccentSctNameEs)
    {
        $this->unaccentSctNameEs = $unaccentSctNameEs;

        return $this;
    }

    /**
     * Get unaccentSctNameEs
     *
     * @return string 
     */
    public function getUnaccentSctNameEs()
    {
        return $this->unaccentSctNameEs;
    }

    /**
     * Set idCie10
     *
     * @param \Minsal\SiapsBundle\Entity\MntCie10 $idCie10
     * @return MntSnomedCie10
     */
    public function setIdCie10(\Minsal\SiapsBundle\Entity\MntCie10 $idCie10 = null)
    {
        $this->idCie10 = $idCie10;

        return $this;
    }

    /**
     * Get idCie10
     *
     * @return \Minsal\SiapsBundle\Entity\MntCie10 
     */
    public function getIdCie10()
    {
        return $this->idCie10;
    }
}
